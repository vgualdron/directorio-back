<?php

namespace App\Exceptions;

use Exception;

class AuthenticateException extends Exception
{
    public function report() {
        return false;
    }

    public function render() {
        return response()->json([
            'errors' => 'Usuario o contraseña incorrecta.',
            'message' => 'Usuario o contraseña incorrecta.'
        ], 401);
    }
}
