<?php

namespace Traits;

trait ResponseFormatter{
    public function responseFormatter($code, $messaeg, $data = null){
        return json_encode([
            "code" => $code,
            "msg"=> $messaeg,
            "data"=> $data
        ]);
    }
}