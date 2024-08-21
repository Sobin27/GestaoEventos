<?php
namespace App\Http\Controllers;


use App\Core\Service\Login\ILoginService;
use App\Core\Service\Login\ILogoutService;
use App\Http\Requests\Login\LoginRequest;
use Symfony\Component\HttpFoundation\Response;

class LoginController extends Controller
{
    public function __construct(
        private readonly ILoginService $loginService,
        private readonly ILogoutService $logoutService,
    )
    { }

    public function login(LoginRequest $request): Response
    {
        try {
            return $this->response(
              message: 'Login successfully',
              data: $this->loginService->login($request),
              code: Response::HTTP_OK
            );
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
    public function logout(): Response
    {
        try {
            return $this->response(
                message: 'Logout successfully',
                data: true,
                code: Response::HTTP_OK
            );
        }catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], Response::HTTP_BAD_REQUEST);
        }
    }
}
