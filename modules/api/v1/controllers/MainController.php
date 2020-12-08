<?php

namespace app\modules\api\v1\controllers;

use app\controllers\BaseController;

/**
 * Default controller for the `v1` module
 */
class MainController extends BaseController
{
    /**
     * @return string[]
     */
    public function actionIndex(): array
    {
        return ['message' => 'Api works'];
    }
}
