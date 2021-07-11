<?php

namespace app\traits;

trait JsonTrait
{    
    public array $answer = [
        'status' => 0,
        'error' => null,
    ];

    public function parseJson() : array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    public function answerJson()
    {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return $this->answer;
    }
}
