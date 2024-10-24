<?php

namespace Controller;

include "Traits/ResponseFormatter.php";
include "Controllers/Controller.php";

use Traits\ResponseFormatter;

class ProductController extends Controller {
    use ResponseFormatter;
    public function __construct() {
        $this->controllerName = "Get ALL Product";
        $this->controllerMethod = "GET";
    }
    public function getAllProduct(){
        $dumyData = [
            "air aqua",
            "kebab",
            "pangsit",
            "jus jambu"
        ];
        $response = [
            "controller_attribute" => $this->getControllerAtribute(),
            "product" => $dumyData,
        ];
        return $this->responseFormatter(200, "success",$response);
    }
};