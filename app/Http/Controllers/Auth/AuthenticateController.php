<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\JWTAuth;

class AuthenticateController extends ApiController
{
    public function __construct()
    {
        $this->middleware('jwt.auth', ['except' => ['login']]);
    }

    /**
     * Login with userid and password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = $request->only('userid', 'password');

        $token = auth('api')->attempt($credentials);

        try {
            // verify the credentials and create a token for the user
            if (!$token = auth('api')->attempt($credentials)) {

                return $this->setStatusCode(401)->respondWithError(['error' => 'invalid credentials']);
            }
        } catch (JWTException $e) {
            // something went wrong
            return $this->setStatusCode(500)->respondWithError(['error' => 'count_not_create_token']);
        }

        // if no errors are encountered we can return a JWT
        return $this->setStatusCode(200)->respondWithSuccess(
            "Login Successfully ",
            ['token' => $token]
        );
    }

    /**
     * Logout Function
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        try {
            auth('api')->logout();
            return $this->setStatusCode(200)->respondWithSuccess(
                "Logout Successfully"
            );
        } catch (\Exception $e) {
            return $this->setStatusCode(401)->respondWithError($e->getMessage());
        }
    }

    /**
     * get Authenticate User
     * @return \Illuminate\Http\JsonResponse
     *
     */
    public function getAuthenticatedUser() {

        if ($user = auth('api')->user()) {

            return $this->setStatusCode(200)->respondWithSuccess(
                "User found",
                $user
            );
        }

        return $this->setStatusCode(500)->respondWithError("User not found");
    }

}
