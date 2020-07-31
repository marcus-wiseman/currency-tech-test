<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class AuthController
 */
class AuthController extends Controller
{

    /**
     * Authorise api requests
     *
     * @param Request $request
     * @return void
     */
    public function auth (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        if (!Auth::attempt($request->all())) {
            return response([
                'status' => false,
                'message' => 'Invalid login credentials'
            ]);
        }

        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response([
            'status' => true,
            'access_token' => $accessToken
        ]);
    }
}
