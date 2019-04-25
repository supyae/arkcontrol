<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{
    protected $statusCode = 200;
    protected $validationRules = [];

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param       $message
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithError($message, $data = [])
    {
//        if (is_array($message)) {
//            $message = implode(',', $message);
//        }

        $respond = [
            "meta" => [
                'success'    => false,
                'messages'   => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ];

        return $this->respond($respond);
    }

    /**
     * Api respond with success
     *
     * @param       $message
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondWithSuccess($message, $data = [])
    {
        $respond = [
            "meta" => [
                'success'    => true,
                'message'    => $message,
                'statusCode' => $this->getStatusCode()
            ]
        ];

        $respond['record'] = $data;

        return $this->respond($respond);
    }

    /**
     * @param       $data
     * @param array $headers
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respond($data, $headers = [])
    {
        $statusCode = $this->getStatusCode();

        return Response::json($data, $statusCode, $headers);
    }

    /**
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function respondNotFound($message = 'Not Found!')
    {
        return $this->setStatusCode(404)->respondWithError($message);
    }

    /**
     * @param       $requiredParameters
     *
     * @param array $data
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkMissingParams($requiredParameters, $data = [])
    {
        $missingParameters = [];

        foreach ($requiredParameters as $parameter) {
            if (!Input::get($parameter)) {
                $missingParameters[] = $parameter;
            }
        }

        if (!empty($missingParameters)) {
            $missingParametersString = implode(',', $missingParameters);

            $errorMessage = 'Missing required parameters: ' . $missingParametersString;

            return $this
                ->setStatusCode(401)
                ->respondWithError($errorMessage, $data);
        }
    }

    public function checkAuthUser()
    {
        if (empty(auth()->user()->id)) {

            return $this->setStatusCode(401)
                ->respondWithError("User is invalid");
        }
    }

    public function authUserData()
    {
        try {
            $user = auth()->user();

            return $user;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @return array
     */
    public function getValidationRules(): array
    {
        return $this->validationRules;
    }

    public function setValidationRules(array $validationRules)
    {
        $this->validationRules = $validationRules;
        return $this;
    }

    public function validateData($input) {

        $validator = Validator::make($input, $this->getValidationRules());

        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $key => $value) {
                $errors[$key] = $value[0];
            }

            return $this->setStatusCode(422)
                ->respondWithError($errors);
        }
    }


}
