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
    O seu usuário foi cadastrado no sistema Gestão de Eventos.
</p>
<form method="POST" action="{{ route('confirm.email', ['userUuid' => $user->uuid]) }}">
    @csrf
    @method('PUT')
    Para validar seu email clique no botão abaixo:
    <button type="submit" class="btn btn-primary">confirmar cadastro</button>
</form>
</body>
</html>
