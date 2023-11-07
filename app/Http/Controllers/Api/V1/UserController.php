<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function show(User $user)
    {
        return response()->json(['user' => $user]);
    }
}
