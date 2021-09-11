<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Message</title>
</head>
<body>
    @dd($message)
    {{-- con il dd inva dati in ispeziona->network senza dd sa errore su $guest_name --}}
    <h1>Hai ricevuto un messaggio da: </h1>
    <div>
        <p><strong>Nome: </strong></p> {{ $message->guest_name }}
        <p><strong>email: </strong></p> {{ $newMessage->guest_email }}
        <p><strong>Messaggio: </strong></p> {{ $newMessage->content }}
    </div>
</body>
</html>