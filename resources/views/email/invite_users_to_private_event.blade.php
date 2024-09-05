<!DOCTYPE html>
<html lang="pt-br" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
    <title>
        Confirmar Email
    </title>
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
</head>
<body>
<h3>Olá, {{ $user->name}}!</h3>
<p>
    Entrando em contato atráves do sistema Gestão de Eventos para informar que o evento no qual você foi convidado a
    participar do Evento Privado:{{ $events->name }}.
</p>
<p>
<form method="POST" action="{{ route('participate-private-event', ['eventId' => $events->id, 'userId' => $user->id]) }}">
    @csrf
    Para confirmar sua presença clique no botão abaixo:
    <button type="submit" class="btn btn-primary">confirmar participação</button>
</form>
</p>
</body>
</html>
