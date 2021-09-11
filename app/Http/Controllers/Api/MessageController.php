<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        //validaizione maunale
        $validator = Validator::make($data, [
            'guest_name' => 'required|max:30',
            'guest_email' => 'required|max:30',
            'content' => 'required'
        ],
        [
            'guest_name.required' => 'tua mamma',
            'guest_email.required' => 'tua zia',
            'content.required' => 'riempi sto container'
        ]);
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        //salvataggio a db
        $newMessage = new Message();
        $newMessage->fill($data);
        $newMessage->save();

        //invio mail ad admin

        return response()->json($data);
    }
}