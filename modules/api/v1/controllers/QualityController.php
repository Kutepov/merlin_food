<?php

namespace app\modules\api\v1\controllers;

/**
 * Quality controller for the `v1` module
 */
class QualityController extends MainController
{
    public $modelClass = 'app\models\Quality';

    /**
     * Rest Description: Get all Quality.
     */
    public function actionIndex() {}

    /**
     * Rest Description: Create Quality.
     * Rest Fields: ['name', 'characteristic_id'].
     */
    public function actionCreate() {}

    /**
     * Rest Description: Update Quality.
     * Rest Fields: ['name', 'characteristic_id'].
     */
    public function actionUpdate() {}

    /**
     * Rest Description: View Quality.
     */
    public function actionView() {}

    /**
     * Rest Description: Delete Quality.
     */
    public function actionDelete() {}
}
