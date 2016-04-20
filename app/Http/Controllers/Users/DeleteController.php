<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\User;

class DeleteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | User Delete Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for deleting users
    |
    */

    /**
     * Create a new user delete controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($user) {
        $user->delete();
        redirect(action('HomeController@index'));
    }
}
