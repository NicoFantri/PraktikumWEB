<?php

namespace Controller;

class Controller
{
    var $controllerName;
    var $controllerMethod;

    public function getControllerAtribute()
    {
        return[
            "ControllerName" => $this->controllerName,
            "ControllerMethod"=> $this->controllerMethod,
        ];
    }
}