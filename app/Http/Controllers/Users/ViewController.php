<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\AuthController;
use Illuminate\Http\Request;
use App\User;
use App\Profile;

class ViewController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User View Controller
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
     * Show the application user view page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user, Request $request) {
        $parents = [];
        $father = $user->profile->father()->with('profile')->first();
        $mother = $user->profile->mother()->with('profile')->first();
        if ($father) $parents[] = $father;
        if ($mother) $parents[] = $mother;
        $partner = $user->profile->partner()->with('profile')->first();
        $children = $user->profile->children()->with('profile')->get();
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'user' => $user,
                'parents' => $parents,
                'partner' => $partner,
                'children' => $children,
            ]);
        }
        return view('users.view', [
            'user'=>$user,
            'parents'=>$parents,
            'partner'=>$partner,
            'children'=>$children,
        ]);
    }

}
