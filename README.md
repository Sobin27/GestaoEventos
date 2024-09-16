# API de Gestão de Eventos
Para fins de estudo, foi desenvolvida uma API para gestão de eventos. 
A API foi desenvolvida utilizando o framework Laravel, e o banco de dados MySQL, utilizando da arquitetura Hexagonal, 
API permite a criação, edição, exclusão e listagem de eventos, além de permitir a criação de 
usuários e autenticação.

## Instalação
Para instalar a API, siga os passos abaixo:
```bash
git clone https://github.com/Sobin27/GestaoEventos.git
```
Após fazer o clone do projeto, acesse a pasta do projeto e execute o comando abaixo para instalar as dependências:
```bash
composer update
````
Ou, se preferir, você pode utilizar o docker para rodar o projeto no seu local, utilizando os comandos abaixo:

### Montar a imagem docker:
```bash
docker build -t gestaoeventos 'caminho_do_projeto'
````
### Rodar o container:
```bash
docker run -d -p 8000:80 gestaoeventos 
````
Após você ter configurado o ambiente você deve rodar as migrations para consegui utilizar o banco de dados, para isso execute o comando abaixo:

*Obs*: deve ser configurado o seu .env antes de executar esse comando, adicionando as credenciais do seu banco de dados.
```bash
php artisan migrate
````
Você deve configurar seu .env com informações smtp para poder utilizar de algumas funções que o sistema possue, para isso, 
adicione as seguintes informações no seu .env:
```
> MAIL_MAILER=smtp<br />
> MAIL_HOST=seu_host<br />
> MAIL_PORT=2525<br />
> MAIL_USERNAME=seu_usuario<br />
> MAIL_PASSWORD=sua_senha<br />
> MAIL_ENCRYPTION=tls<br />
> MAIL_FROM_ADDRESS="hello@example.com"<br />
> MAIL_FROM_NAME="${APP_NAME}"<br />
```
Após finalizar a migração, você pode utilizar o projeto tranquilamente.

*Obs*:
Caso você tenha optado por não utilizar o container docker, depois de ter configurado suas migrações e .env rode
o comando abaixo para rodar o servidor:
```bash
php artisan serve
````

## Utilização
Para utilizar a API, você pode utilizar o Postman ou Insomnia.

## API
<details>
<summary>CRUD Usuario</summary>

| MÉTODO | ROTA                                 |
|--------|--------------------------------------|
| POST   | /api/user/create                     |
| ------ | ------------------------------------ |
| PUT    | /api/user/update                     |
| ------ | ------------------------------------ |
| GET    | /api/user/list                       |

<details>   
<summary>Criar usuário</summary>
Rota: /api/user/create

Para criar um usuário, você deve enviar um json no seguinte formato:
```json
{
    "name": "Seu nome",
    "email": "Seu email",
    "password": "Sua senha",
    "login": "Seu login"
}
```
Retorno:
```json
{
    "message": "User created successfully",
    "data": true
}
```
</details>

<details>   
<summary> Editar usuário</summary>
Rota: /api/user/update

Para editar um usuário, você deve enviar um json no seguinte formato:
```json
{
    "uuid": "uuid_do_usuario",
    "name": "Seu nome",
    "email": "Seu email",
    "login": "Seu login"
}
```
Retorno:
```json
{
    "message": "User updated successfully",
    "data": true
}
```
</details>

<details>   
<summary> Listar usuário</summary>
Rota: /api/user/list

Retorno:
```json
{
    "message": "Users listed successfully",
    "data": [
        {
            "id": 1,
            "name": "teste",
            "email": "teste2@example.com"
        }
    ]
}
```
Caso queira listar um usuário específico, você pode passar os seguintes filtros:

```
"name": "Seu nome",
"email": "Seu email",
```
</details>

</details>

<details>   
<summary> Authentication</summary>

|MÉTODO| ROTA                                 |
|------|--------------------------------------|
| POST | /api/authentication/login                     |
|------| ------------------------------------ |
| POST | /api/authentication/logout                     |

<details> 
<summary>Login</summary>
Rota: /api/authentication/login

Para fazer login, você deve enviar um json no seguinte formato:
```json
{
    "login": "Seu login",
    "password": "Sua senha"
}
```

Retorno:
```json
{
    "message": "Login successfully",
    "data": {
        "Name": "teste",
        "Email": "teste2@example.com",
        "Token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOi8vbG9jYWxob3N0OjgwMDAvYXBpL2F1dGhlbnRpY2F0aW9uL2xvZ2luIiwiaWF0IjoxNzI2NTA2MTY1LCJleHAiOjE3MjY1OTI1NjUsIm5iZiI6MTcyNjUwNjE2NSwianRpIjoiZmFLRjRhVDJIZjJ2TENMbiIsInN1YiI6IjEiLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.s5NjNJ3g2mgHr8F6FF2HM8wS_Py8U5hxD_kKsezXRjY"
    }
}
```

</details>

<details> 
<summary>Logout</summary>
Rota: /api/authentication/logout

Retorno:
```json
{
    "message": "Logout successfully",
    "data": true
}
```
</details>

</details>

<details> 
<summary>CRUD Eventos</summary>

| MÉTODO | ROTA                                 |
|--------|--------------------------------------|
| POST   | /api/event/create                     |
| ------ | ------------------------------------ |
| POST   | /api/event/to-participate/{eventId}                     |
| ------ | ------------------------------------ |
| PUT    | /api/event/update                     |
| ------ | ------------------------------------ |
| GET    | /api/event/list                     |
| ------ | ------------------------------------ |
| GET    | /api/event/details/{eventId}                     |
| ------ | ------------------------------------ |
| DELETE | /api/event/stop-participating/{eventId}                     |
| ------ | ------------------------------------ |
| GET    | /api/event/my-events                     |
| ------ | ------------------------------------ |
| POST   | /api/event/cancel/{eventId}                     |


<details> 
<summary>Criar evento</summary>
Rota: /api/event/create

Para criar um evento, você deve enviar um json no seguinte formato:
1ª Caso o evento for publico:
```json
{
    "name": "Tech Conference 2024",
    "description": "A conference focused on the latest in technology.",
    "type": "Publico",
    "organizingCompany": "TechCorp",
    "maxParticipants": 10,
    "durationTime": "3 days",
    "eventDate": "2024-10-15",
    "address": "123 Tech Street",
    "city": "San Francisco",
    "country": "USA",
    "state": "California"
}
```
2º Caso o evento for privado:
```json
{
    "name": "Tech Conference 2024",
    "description": "A conference focused on the latest in technology.",
    "type": "Privada",
    "organizingCompany": "TechCorp",
    "maxParticipants": 10,
    "durationTime": "3 days",
    "eventDate": "2024-10-15",
    "address": "123 Tech Street",
    "city": "San Francisco",
    "country": "USA",
    "state": "California",
    "invitesUsers": [1,2]
}
```

Retorno:
```json
{
    "message": "Event created successfully",
    "data": true
}
```

</details>

<details> 
<summary>Participar do evento</summary>
Rota: /api/event/to-participate/{eventId}

Para participar de um evento, primeiro, ele deve ser público e você precisa está logado, caso atenda esses requistos, você vai receber 
o seguinte retorno
Retorno:
```json
{
    "message": "Event to participate successfully",
    "data": true
}
```

Caso o evento não seja publico, você vai receber o seguinte retorno:
```json
{
    "message": "Event is not public"
}
```
Caso o numero de participantes do evento ja tenha sido atingido, você
recebera o seguinte retorno:
```json
{
    "message": "Event has no vacancies"
}
```
Caso o evento não esteja mais ativo, você recebera o seguinte
retorno:
```json
{
    "message": "Event is not active"
}
```


</details>

<details> 
<summary>Editar o evento</summary>
Rota: /api/event/update

```json
{
  "eventId": "required|integer",
  "name": "string",
  "description": "string",
  "type": "string",
  "organizingCompany": "string",
  "maxParticipants": "integer",
  "durationTime": "string",
  "eventDate": "date",
  "address": "string",
  "city": "string",
  "country": "string",
  "state": "string",
  "active": "boolean"
}
```

Retorno:
```json
{
    "message": "Event updated successfully",
    "data": true
}
```


</details>

<details> 
<summary>Listar Eventos</summary>
Rota: /api/event/list?page=1&perPage=10

Passe a paginação que você queira e receberar o seguinte retorno:

```json
{
    "message": "Event list successfully",
    "data": {
        "list": [
            {
                "id": 1,
                "name": "Tech Conference 2024",
                "description": "A conference focused on the latest in technology.",
                "type": "Publica",
                "eventOrganizer": 1,
                "organizingCompany": "TechCorp",
                "active": 1,
                "maxParticipants": 10,
                "durationTime": "3 days",
                "eventDate": "2024-10-15 00:00:00",
                "createdAt": "2024-09-16 17:38:25",
                "updatedAt": "2024-09-16 17:38:25",
                "eventOrganizerName": "teste",
                "participantsCount": 1
            }
        ],
        "pagination": {
            "total": 1,
            "perPage": 10,
            "currentPage": 1
        }
    }
}
```

Caso queira listar um usuário específico, você pode passar os seguintes filtros:

```
"type": "Publica" ou "Privada",
"active": "True" ou "False",
"name": "nome_do_evento",
```

</details>


<details> 
<summary>Detalhes do Evento</summary>
Rota: /api/event/details/{eventId}

Retorno
```json
{
    "message": "Event details list successfully",
    "data": {
        "eventName": "Tech Conference 2024",
        "eventDescription": "A conference focused on the latest in technology.",
        "eventType": "Publica",
        "eventOrganizer": "teste",
        "eventActive": 1,
        "eventDuration": "3 days",
        "eventDate": "2024-10-15 00:00:00",
        "eventAddress": "123 Tech Street",
        "eventCity": "San Francisco",
        "eventState": "California",
        "eventCountry": "USA",
        "participantsCount": 1
    }
}
```

</details>


<details> 
<summary>Parar de participar de um Evento</summary>
Rota: /api/event/stop-participating/{eventId}

Você precisa está logado e participar de um evento, após inserir o evento 
que partcipa, receberá o seguinte retorno:
```json
{
    "message": "Event stop participating successfully",
    "data": true
}
```

</details>

<details> 
<summary>Meus Eventos</summary>
Rota: /api/event/my-events?page=1&perPage=10

Você precisa está logado e participar de um evento. 

Retorno:
```json
{
    "message": "My events listing successfully",
    "data": {
        "list": [
            {
                "id": 1,
                "name": "Tech Conference 2024",
                "type": "Publica",
                "organizingCompany": "TechCorp",
                "active": 1,
                "durationTime": "3 days",
                "eventDate": "2024-10-15 00:00:00",
                "participantsCount": 1
            }
        ],
        "pagination": {
            "total": 1,
            "perPage": 10,
            "currentPage": 1
        }
    }
}
```

</details>

<details> 
<summary>Cancelar o Evento</summary>
Rota: /api/event/cancel/{eventId}

Você precisa inserir o evento em que você é o organizador.

Retorno:
```json
{
    "message": "Event canceled successfully",
    "data": true
}
```

</details>



</details>


## Testes
Para rodar os testes, você deve rodar o comando abaixo:
```bash
php artisan test
```

Caso queira rodar apenas os testes de serviço:
```bash
php artisan test tests/Unit/Services
```

Caso queira rodar apenas os testes de feature:
```bash
php artisan test tests/Feature
```

Caso queira rodar um teste específico, você pode rodar o comando abaixo:
```bash
php artisan test --filter=Class_test
```
