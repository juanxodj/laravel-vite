<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends BaseController
{
  public function login(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|email',
      'password' => 'required'
    ]);

    if ($validator->fails()) {
      return $this->handleError($validator->errors());
    }

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      $user = Auth::user();
      $success['token'] =  $user->createToken('authToken')->accessToken;
      $success['user'] =  $user;
      $success['permissions'] =  Helper::getUserPermissions($user);

      return $this->handleResponse($success, __("auth.user-logged-in"));
    } else {
      return $this->handleError(__("auth.unauthorized"), ['error' => __("auth.unauthorized")]);
    }
  }

  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required',
      'confirm_password' => 'required|same:password',
    ]);

    if ($validator->fails()) {
      return $this->handleError($validator->errors());
    }

    $input = $request->all();
    $user = User::create($input);
    $success['token'] =  $user->createToken('authToken')->accessToken;
    $success['name'] =  $user->name;

    return $this->handleResponse($success, __("auth.user-successfully-registered"));
  }
}
