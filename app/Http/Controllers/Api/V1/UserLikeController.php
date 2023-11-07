<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\SendLikeEvent;
use App\Http\Controllers\Controller;
use App\Models\User;

class UserLikeController extends Controller
{
    public function sendLike(User $user)
    {
        $likeString = 'User with id: '.auth()->user()->id.' liked your profile';
        broadcast(new SendLikeEvent($user, $likeString))->toOthers();

        return response()->json(['like_string' => $likeString]);
    }
}
