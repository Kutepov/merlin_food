<?php

namespace app\modules\api\v1\controllers;


/**
 * Characteristic controller for the `v1` module
 */
class CharacteristicController extends MainController
{
    public $modelClass = 'app\models\Characteristic';

    /**
     * Rest Description: Get all Characteristics.
     */
    public function actionIndex() {}

    /**
     * Rest Description: Create Characteristic.
     * Rest Fields: ['name', 'max_points'].
     */
    public function actionCreate() {}

    /**
     * Rest Description: Update Characteristic.
     * Rest Fields: ['name', 'max_points'].
     */
    public function actionUpdate() {}

    /**
     * Rest Description: View Characteristic.
     */
    public function actionView() {}

    /**
     * Rest Description: Delete Characteristic.
     */
    public function actionDelete() {}
}
