<?php

use Illuminate\Database\Seeder;
use App\Message;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i < 6; $i++) {
            $message = new Message();
            $message->house_id = $i;
            $message->guest_name = 'user' . $i;
            $message->guest_email = 'user' . $i . '@gmail.com';
            $message->content = 'Messaggio di prova ' . $i;
            $message->save();
        }
    }
}
