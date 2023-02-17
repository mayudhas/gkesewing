<?php

namespace Panel\Authentication\Services;

use App\Helpers\CookieHelper;
use App\Models\UserModel;
use CodeIgniter\HTTP\Request;

class AuthService
{

    public function __construct(
        private UserModel $userModel
    )
    {
    }

    /**
     * @throws \Exception
     */
    public final function validationLogin(Request $request): array
    {
        $post = $request->getPost();
        $user = $this->userModel->where('user_username', $post['username'])->first();
        if (!$user) throw new \Exception('the user has not been registered.');
        if (!password_verify($post['password'], $user->user_password)) throw new \Exception('username and password do not match.');
        unset($user->created_at, $user->updated_at, $user->user_password);
        $dataCookie = encrypt(json_encode(array_merge(['session_id' => random_string('alnum', 64), 'logged_in' => TRUE], $user->toArray())));
        CookieHelper::setCookie(value: $dataCookie);
        return $user->toArray();
    }

}