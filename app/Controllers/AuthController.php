<?php

namespace App\Controllers;

use App\Models\Job;
use App\Models\Project;
use App\Models\User;
use Respect\Validation\Validator as v;
use Laminas\Diactoros\Response\RedirectResponse;

class AuthController extends BaseController {
    public function getLogin($request) {
        return $this->renderHTML('login.twig');
    }
    public function postLogin($request) {
        $postData = $request->getParsedBody();
        $responseMessage = null;

        $user = User::where('email', $postData['email'])->first();
        if ($user) {
            if (password_verify($postData['password'], $user->password)) {
                $jobs = Job::all();
                $projects = Project::all();

                $_SESSION['email'] = $user->email;
                $email = $user->email;
                $limitMonths = 2000;
                $_SESSION['userId'] = $user->id;
                return $this->renderHTML('index.twig', [
                    'email' => $email,
                    'jobs' => $jobs,
                    'projects' => $projects
                ]);
            }else {
                $responseMessage = 'Bad credentials';
            }
        }else {
            $responseMessage = 'Bad credentials';
        }

        return $this->renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }

    public function getLogout() {
        $responseMessage = 'You must login for continue.';
        unset($_SESSION['userId']);
        return $this->renderHTML('login.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}