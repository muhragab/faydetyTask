<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\LoginRequest;
use App\Http\Requests\Api\ProfileRequest;
use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use function GuzzleHttp\Promise\all;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $input = $request->except('avatar');
        if ($request->file('avatar')) {
            $file = $request->file('avatar');
            $image = time() . '.' . $file->getClientOriginalExtension();
            $request['avatar']->move(public_path('user/avatar/'), $image);
            $avatar = 'user/avatar/' . $image;
        }
        $user = User::create(array_merge($input, ['avatar' => $avatar]));
        return $this->sendResponse($user, '', 201);
    }

    public function login(LoginRequest $request)
    {
        Auth::attempt(['phone_number' => $request->phone_number, 'password' => $request->password]);
        try {
            $token = Str::random(60) . time();
            $user = User::where('id', \auth()->user()->id)->update([
                'auth_token' => $token
            ]);
            return $this->sendResponse(['auth_token' => $token], '');
        } catch (\Exception $e) {
            return $this->sendError('Error login');
        }
    }

    public function profile(ProfileRequest $request)
    {
        try {
            $user = User::where($request->all())->first();
            return $this->sendResponse($user, '');
        } catch (\Exception $e) {
            return $this->sendError('Error');
        }
    }
}
