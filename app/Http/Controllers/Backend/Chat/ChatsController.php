<?php

namespace App\Http\Controllers\Backend\Chat;

use App\Models\Message;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChatsController extends Controller
{
    /**
     * Fetch all messages.
     *
     * @return Message
     */
    public function fetchMessages()
    {
        return Message::with('user')->get();
    }

    /**
     * Persist message to database.
     *
     * @param  Request $request
     * @return Response
     */
    public function sendMessage(Request $request)
    {
        $message = $request->user()->messages()->create([
            'message' => $request->input('message'),
        ]);

        broadcast(new MessageSent($request->user(), $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
