<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use App\Models\Company;

class AuthController extends BaseController
{
    use AuthenticatesUsers;

    public function user(Request $request): JsonResponse
    {
        $userData =  auth('sanctum')->user();

        return $this->sendResponse($userData, 'User data');
    }

    public function signIn(Request $request): JsonResponse
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => ['required', 'email'],
                'password' => ['required'],
            ],
            [
                'email.required' => 'メールフィールドは必須です。',
                'email.email' => 'メールは有効なメールアドレスである必要があります。',
                'password.required' => 'パスワードフィールドは必須です。',
            ]
        );

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            $authUser = auth('sanctum')->user();
            if($authUser->getAttribute('role') == 1){
                // $success['token'] =  $authUser->createToken('auth_token', [$authUser->getAttribute('role').'Role'])->plainTextToken;
                $success['name'] =  $authUser->getAttribute('user_name');
                $company = Company::find($authUser->getAttribute('company_id'));
                $success['company_name'] = $company->company_name;
                // $success['role'] =  $authUser->getAttribute('role');
                $success['email'] =  $authUser->getAttribute('email');
                return $this->sendResponse($success, 'ログインしました。');
            } else {
                return $this->sendError('会社管理者ではありません。', ['error'=>'NO Boss']);
            }
        }
        else{
            return $this->sendError('無効なメールアドレスまたはパスワード。', ['error'=>'Unauthorised']);
        }
    }

    public function signUp(Request $request): JsonResponse
    {
        $input = $request->all();
        $validator = Validator::make(
            $input,
            [
                'email'                 => 'required|email|max:255|unique:users',
                'password'              => 'required|min:6|max:30|confirmed',
                'password_confirmation' => 'required|same:password',
                'username' => 'required'
            ],
            [
                'email.required' => 'メールフィールドは必須です。',
                'email.unique' => 'メールはすでに取られています。',
                'email.email' => 'メールは有効なメールアドレスである必要があります。',
                'email.max' => '電子メールは255文字を超えてはなりません。',

                'password.required' => 'パスワードフィールドは必須です。',
                'password.min' => 'パスワードは6文字以上である必要があります。',
                'password.max' => 'パスワードは30文字以内にする必要があります。',
                'password.confirmed' => 'パスワードの確認が一致しません。',

                'password_confirmation.required' => 'パスワード確認フィールドは必須です。',
                'password_confirmation.same' => 'パスワードの確認とパスワードは一致している必要があります。',
               
                'required' => 'この項目は必須です。',
            ]
        );

        if($validator->fails()){
            return $this->sendError('Error validation', $validator->errors());
        }

        $input = $request->all();
        $input['birthday'] = date_format(date_create($input['birthday']), 'Y-m-d');
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('auth_token', [$user->getAttribute('role')])->plainTextToken;
        $success['name']  =  $user->getAttribute('name');
        $success['email'] =  $user->getAttribute('email');

        return $this->sendResponse($success, 'User created successfully.');
    }
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

}
