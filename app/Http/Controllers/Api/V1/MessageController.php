<?php

namespace App\Http\Controllers\Api\V1;

use App\Events\SendMessageEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Message\StoreRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;

class MessageController extends Controller
{
    public function index()
    {
        $messages = Message::latest()->get();

        return MessageResource::collection($messages);
    }

    public function store(StoreRequest $request)
    {
        $message = Message::create($request->validated());
        broadcast(new SendMessageEvent($message))->toOthers();

        return MessageResource::make($message);
    }
}
