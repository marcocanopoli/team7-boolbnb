<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessage;
use App\Message;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        //validaizione maunale
        $validator = Validator::make($data, [
            'guest_name' => 'required|max:30',
            'guest_email' => 'required|email|max:30',
            'content' => 'required'
        ],
        [
            'guest_name.required' => 'inserisci nome',
            'guest_email.required' => 'inserisci mail',
            'guest_email.email' => 'inserisci mail valida',
            'content.required' => 'scrivi un messaggio'
        ]);
        
        if($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ]);
        }
        //salvataggio a db
        $message = new Message();
        $message->fill($data);
        $message->save();

        //invio mail ad admia

        Mail::to('admin@sito.com')->send(new ContactMessage($message));

        return response()->json([
            'success' => true
            //per debug $data senza []
        ]);
    }
}