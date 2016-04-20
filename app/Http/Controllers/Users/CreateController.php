<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use App\Jobs\SlackNotifier;
use Illuminate\Http\Request;
use Validator;
use App\User;
use App\Profile;

class CreateController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Create Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for creating users
    |
    */

    /**
     * Create a new user create controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application user create form.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $users = User::with('profile')->lists('email', 'id');
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'status'=>TRUE,
                'title'=>'Create a new user',
                'html'=>view('users.create-popup', ['users'=>$users])->render()
            ]);
        }
        return view('users.create', ['users'=>$users]);
    }

    /**
     * Get a validator for an incoming user creation request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
          'email' => 'required|email|max:255|unique:users',
          'first_name' => 'required|max:255',
          'last_name' => 'required|max:255',
          'gender' => 'required|in:1,2',
          'parents_father' => 'exists:users,id',
          'parents_mother' => 'exists:users,id',
          'partner' => 'exists:users,id',
          'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a create form validation.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data) {
        $user = User::create([
          'email' => $data['email'],
          'password' => bcrypt($data['password']),
        ]);
        $this->createProfle($user, $data);
        $this->dispatch(new SlackNotifier($user));
        return $user;
    }

    /**
     * Create a new profile instance after a create form validation.
     *
     * @param  User  $user
     * @param  array  $data
     * @return Profile
     */
    protected function createProfle(User $user, array $data) {
        $profile = Profile::create([
            'user_id' => $user->id,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'gender' => $data['gender'],
            'parents_father' => $data['parents_father'],
            'parents_mother' => $data['parents_mother'],
            'partner' => $data['partner'],
        ]);
        $profile->updatePartner();
        if (isset($data['children']) && !empty($data['children'])) {
            $profile->updateChildren($data['children']);
        }
        return $profile;
    }

    /**
     * Handle a user creation request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postCreate(Request $request) {
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
              $request, $validator
            );
        }

        if ($this->create($request->all())) {
            return redirect('home');
        }
    }
}
