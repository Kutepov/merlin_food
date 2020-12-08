<?php

namespace app\controllers;

class SiteController extends BaseController
{
    /**
     * @return array|string[]
     */
    public function actionError(): array
    {
        $exception = \Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            return ['message' => $exception->getMessage()];
        }
        return ['message' => 'Unknown error'];
    }

    /**
     * Check work
     *
     * @return string[]
     */
    public function actionIndex(): array
    {
        return ['message' => 'Service works!'];
    }
}
