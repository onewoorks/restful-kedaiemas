<?php

namespace App\Controllers;

use App\Models\Kedai;

class HomeController extends Controller {

    public function index($request, $response) {
        $user = Kedai::where('id',1)->first();
        return $this->view->render($response, 'home.twig');
    }

}
