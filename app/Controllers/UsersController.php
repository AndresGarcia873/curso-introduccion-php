<?php

namespace App\Controllers;

use App\Models\User;
use Respect\Validation\Validator as v;

class UsersController extends BaseController {
    public function getAddUserAction($request) {
        $responseMessage = null;
        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();
            $projectValidator = v::key('email', v::stringType()->notEmpty())
                ->key('password', v::stringType()->notEmpty());

            try {
                $projectValidator->assert($postData);
                $postData = $request->getParsedBody();

                $encrypted_key = password_hash($postData['password'], PASSWORD_DEFAULT);

                $user = new User();
                $user->email = $postData['email'];
                $user->password = $encrypted_key;
                $user->save();

                $responseMessage = 'User Created Successfully';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        return $this->renderHTML('addUser.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}