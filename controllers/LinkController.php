<?php

namespace app\controllers;

use yii\web\Controller;
use yii\web\Response;
use app\models\Link;
use Yii;

class LinkController extends Controller
{
    use \app\traits\JsonTrait;


    public function beforeAction($action) {
        $this->enableCsrfValidation = ($action->id !== "create");
        return parent::beforeAction($action);
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionCreate()
    {
        try {
            // распаковка JSON
            $data = $this->parseJson();

            if (empty($data['string'])) throw new \Exception("Отсутствует имя ссылки");

            $string = trim($data['string']);

            if (!Yii::$app->LinkService->isUrl($string)) throw new \Exception("Ссылка должна быть URL-адресом");
            
            $string = Yii::$app->LinkService->toggleHttp($string);

            if ( $link = Link::findOne(['link_name' => $string]) ) {
                // такая ссылка уже есть, возвращаем её алиас
                $this->answer['status'] = 1;
                $this->answer['data']['alias'] = $link->alias;
            } else {

                // генерация уникального алиаса (через сервис)
                $alias = Yii::$app->LinkService->genAlias(6);

                // сохранение алиаса
                $link = new Link;
                $link->alias = $alias;
                $link->link_name = $string;
                $link->save();

                // возврат алиаса
                $this->answer['status'] = 1;
                $this->answer['data']['alias'] = $link->alias;
            }

        } catch (\Throwable $th) {
            $this->answer['error'] = [
                'message'   => $th->getMessage(),
                'file'      => $th->getFile(),
                'line'      => $th->getLine(),
                'trace'     => $th->getTrace()
            ];
        }

        return $this->answerJson();
    }

    public function actionRedirect($alias)
    {
        $link = Link::findOne(['alias'=>$alias]);

        if (empty($link)) {
            \Yii::$app->response->statusCode = 404;
            return $this->redirect(['site/error']);
        }

        return \Yii::$app->response->redirect($link->link_name);
    }
}