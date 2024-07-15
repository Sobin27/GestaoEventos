<?php
namespace App\Http\Controllers;

use App\Core\Service\User\IUserConfirmEmailService;
use App\Core\Service\User\IUserCreateService;
use App\Http\Requests\User\UserCreateRequest;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly IUserCreateService $userCreateService,
        private readonly IUserConfirmEmailService $confirmEmailService,
    )
    { }

    public function createUser(UserCreateRequest $request): Response
    {
        try {
            return $this->response(
                message: 'User created successfully',
                data: $this->userCreateService->createUser($request),
                code: 201
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
    public function confirmEmail(string $uuid)
    {
        try {
            return $this->response(
                message: 'Email confirmed successfully',
                data: $this->confirmEmailService->confirmEmail($uuid),
                code: 200
            );
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
