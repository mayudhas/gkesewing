<?php

namespace App\Helpers;

use CodeIgniter\HTTP\ResponseInterface;
use JetBrains\PhpStorm\ArrayShape;

class ResponseHelper
{
    #[ArrayShape(['message' => "string", 'status' => "bool", 'statusCode' => "int", 'data' => "array|object"])]
    public static function getStatusTrue(string $message = 'Success', int $statusCode = ResponseInterface::HTTP_OK, array|object $data = []): array
    {
        return array('message' => $message, 'status' => true, 'statusCode' => $statusCode, 'data' => $data);
    }

    #[ArrayShape(['message' => "string", 'status' => "false", 'statusCode' => "int", 'data' => "array|object"])]
    public static function getStatusFalse(string $message, int $statusCode = ResponseInterface::HTTP_BAD_REQUEST, array|object $data = []): array
    {
        return ['message' => $message, 'status' => false, 'statusCode' => $statusCode, 'data' => $data];
    }


    #[ArrayShape(['status' => "bool", 'message' => "string"])]
    public static function statusAction(string $message, bool $status): array
    {
        return ['status' => $status, 'message' => $message];
    }

}