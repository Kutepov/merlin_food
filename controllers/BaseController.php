<?php
namespace app\controllers;

use yii\rest\Controller;
use yii\web\Response;

class BaseController extends Controller
{
    /**
     * @var bool|string
     */
    public $layout = false;

    /**
     * @return array|array[]
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    /**
     * @return array|string[]
     */
    public function actionError()
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return ['message' => $exception->getMessage()];
        }
        return ['message' => 'Unknown error'];
    }
}