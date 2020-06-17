<?php

namespace App\Controllers;


use App\Models\{Job,Project};

class IndexController extends BaseController {
    public function indexAction() {

        $jobs = Job::all();
        $projects = Project::all();

        $email = $_SESSION['email'];
        $limitMonths = 2000;

        return $this->renderHTML('index.twig', [
            'email' => $email,
            'jobs' => $jobs,
            'projects' => $projects
        ]);

    }
}