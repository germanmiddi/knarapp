<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\User;


class TokenAuthController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);
        
        $user = User::where('email', $request->email)->first();
        
        if ($user->is_active && Hash::check($request->password, $user->password)) {
            return [ 'user'  => $user,   
                     'token' => $user->createToken($request->device_name)->plainTextToken] ;
        }else{
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }
    
}