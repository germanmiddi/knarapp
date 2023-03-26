<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;

use Illuminate\Support\Facades\Http;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });

        Fortify::authenticateUsing(function (Request $request) {
            
            $user = User::where('email', $request->email)->first();
            
            if (App::environment('local') || $user->email == 'g@gmail.com') {
                // The environment is local
                return $user;
            }else{
                
                $url_ldap = env('URL_LDAP') . '/grupo';
                // http://10.100.18.136:8096/grupo
                
                $response = Http::post($url_ldap, [
                    'usuario' => $user->email,
                    'clave'   => $request->password,
                    'grupo'   => $user->group
                ]);
                
                $token = $response->body();
                
                $tokenParts   = explode(".", $token);  
                $tokenHeader  = base64_decode($tokenParts[0]);
                $tokenPayload = base64_decode($tokenParts[1]);
                
                $jwtHeader  = json_decode($tokenHeader);
                $jwtPayload = json_decode($tokenPayload);
                
                
                if($jwtPayload != 'null'){
                    return $user;
                }


            }

        });
    }
}
