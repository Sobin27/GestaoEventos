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
    Entrando em contato atráves do sistema Gestão de Eventos para informar que o evento no qual você participava,
    Evento: {{ $events->name }} foi cancelado.
</p>
</body>
</html>
