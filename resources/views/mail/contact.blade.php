<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Message</title>
</head>
<body>
    
    {{-- con il dd inva dati in ispeziona->network senza dd sa errore su $guest_name --}}
    <h1>Hai ricevuto un messaggio</h1>
    <div>
        <p><strong>Nome: </strong>{{ $myname }}</p> 
        <p><strong>email: </strong> {{ $myemail }}</p> 
        <p><strong>Messaggio: </strong>{{ $content }}</p>
    </div>
</body>
</html>