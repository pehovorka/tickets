<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;

use App\User;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $facebookUser = Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email'])->user();

        //Create user
        $user = User::firstOrCreate([
            'email' => $facebookUser->getEmail(),
        ],[
            'first_name' => $facebookUser['first_name'],
            'last_name' => $facebookUser['last_name'],
            'provider_id' => $facebookUser->getId(),
        ]);

        //Login the user
        Auth::login($user, true);

        return redirect($this->redirectTo)->with('success','Byli jste úspěšně přihlášeni!');

        // $user->token;
    }
}
