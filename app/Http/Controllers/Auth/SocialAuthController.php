<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
	/**
	 * @method redirectToProvider
	 * @param  string             $provider
	 * @return \Socialite
	 */
    public function redirectToProvider($provider) {
        return \Socialite::driver($provider)->redirect();
    }
    
    /**
     * @method handleProviderCallback
     * @param  string                 $provider
     * @return \Illuinate\Http\Response
     */
    public function handleProviderCallback($provider) {
        $social_user = \Socialite::driver($provider)->user(); 
        
        if ( $user = \App\User::where('email', $social_user->email)->first()) { 
            if($user->status === 'disable') {
                request()->session()->flash('success', 'EL USUARIO CON ESTE E-MAIL SE ENCUENTRA DADO DE BAJA. COMUNIQUESE CON EL ADMINISTRADOR SI PIENSA QUE ES UN ERROR');
                return redirect('/login');
            }
            $user->update([
                'name'  =>  $social_user->name,
                'photo'    =>  $social_user->avatar,
            ]);

            return $this->authAndRedirect($user);
        } else {
            $user = \App\User::create([
                'email'     =>  $social_user->email,
                'photo'     =>  $social_user->avatar,
                'name'  =>  $social_user->name,
                'provider'  =>  $provider
            ]);
 
            return $this->authAndRedirect($user);
        }
    }
 
    /**
     * @method authAndRedirect
     * @param  \App\User          $user
     * @return \Illuminate\Http\Response
     */
    public function authAndRedirect($user) {
        \Auth::login($user);
 
        return redirect()->to('/admin/home');
    }
}
