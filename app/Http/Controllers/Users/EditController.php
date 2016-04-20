<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Profile;

class EditController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Edit Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for updating users
    |
    */

    /**
     * Create a new user edit controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application user edit form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Request $request) {
        $unable_partners = Profile::where('partner_id', '>', 0)->where('user_id', '!=', $user->id)->lists('partner_id')->toArray();
        $user_partners_list = User::whereNotIn('id', $unable_partners)->lists('email', 'id');

        $user_parents_list_query = User::where('id', '!=', $user->id);
        if ($user->profile->isParent()) {
            $children = $user->profile->children()->lists('user_id')->toArray();
            $user_parents_list_query->whereNotIn('id', $children);
        }
        $user_parents_list = $user_parents_list_query->lists('email', 'id');
        $users = User::where('id', '!=', $user->id)->lists('email', 'id');
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
              'status'=>TRUE,
              'title'=>'Edit user',
              'html'=>view('users.edit-popup', [
                    'user'=>$user,
                    'users'=>$users,
                    'user_partners_list'=>$user_partners_list,
                    'user_parents_list'=>$user_parents_list,
              ])->render()
            ]);
        }
        return view('users.edit', [
              'user'=>$user,
              'users'=>$users,
              'user_partners_list'=>$user_partners_list,
              'user_parents_list'=>$user_parents_list,
        ]);
    }

    /**
     * Get a validator for an incoming user creation request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data, User $user)
    {
        return Validator::make($data, [
          'email' => 'required|email|max:255|unique:users,email,'.$user->id,
          'first_name' => 'required|max:255',
          'last_name' => 'required|max:255',
          'gender' => 'required|in:1,2',
          'parents_father' => 'exists:users,id|different_multiple:partner,parents_mother',
          'parents_mother' => 'exists:users,id|different_multiple:partner,parents_father',
          'partner' => 'exists:users,id|different_multiple:parents_mother,parents_father',
          'password' => 'min:6|confirmed',
        ]);
    }

    protected function update(array $data, User $user) {
        $update = ['email' => $data['email']];
        if ($data['password']) $update['password'] = bcrypt($data['password']);
        return $user->update($update);
    }

    protected function profileUpdate(array $data, User $user) {
        $return = $user->profile->update([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'father_id' => $data['parents_father'],
            'mother_id' => $data['parents_mother'],
            'partner_id' => $data['partner'],
        ]);
        $user->profile->updatePartner();
        if (isset($data['children']) && !empty($data['children'])) {
            $user->profile->updateChildren($data['children']);
        }
        return $return;
    }

    /**
     * Handle a user creation request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postUpdate(Request $request, User $user) {
        $validator = $this->validator($request->all(), $user);

        if ($validator->fails()) {
            $this->throwValidationException(
              $request, $validator
            );
        }

        $this->update($request->all(), $user);
        $this->profileUpdate($request->all(), $user);

        return redirect('home');
    }
}
