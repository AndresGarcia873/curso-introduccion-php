<?php

namespace App\Controllers;

use App\Models\Project;
use Respect\Validation\Validator as v;

class ProjectsController extends BaseController {
    public function getAddProjectAction($request) {
        $responseMessage = null;
        if ($request->getMethod() == 'POST') {
            $postData = $request->getParsedBody();
            $projectValidator = v::key('title', v::stringType()->notEmpty())
                ->key('description', v::stringType()->notEmpty());

            try {
                $projectValidator->assert($postData);
                $postData = $request->getParsedBody();

                $files = $request->getUploadedFiles();
                $logo = $files['logo'];
                $route = "noImg";

                if ($logo->getError() == UPLOAD_ERR_OK) {
                    $fileName = $logo->getClientFileName();
                    $datetime =date('GHs');
                    $randomise = rand(1, 9999);
                    $logo->moveTo("uploads/projects/$randomise$datetime$fileName");
                    $route = $randomise.$datetime.$fileName;
                }
                $project = new Project();
                $project->title = $postData['title'];
                $project->description = $postData['description'];
                $project->visible = true;
                $project->image = $route;
                $project->save();

                $responseMessage = 'Project Created Successfully';
            } catch (\Exception $e) {
                $responseMessage = $e->getMessage();
            }
        }
        return $this->renderHTML('addProject.twig', [
            'responseMessage' => $responseMessage
        ]);
    }
}