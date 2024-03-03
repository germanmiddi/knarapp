<?php

namespace App\Http\Controllers\Manager\Setting;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;

class SettingsUserController extends Controller
{
    public function list(){
        return response()->json([
                            'data'=> User::with('roles')->get()
                        ],200);
    }
}
