<?php

namespace app\modules\api\v1\controllers;

use app\components\AccessRule;
use app\models\User;
use yii\filters\AccessControl;
use yii\rest\ActiveController;

/**
 * Default controller for the `v1` module
 */
class MainController extends ActiveController
{
    public $serializer = [
        'class' => 'yii\rest\Serializer',
        'collectionEnvelope' => 'items',
    ];

    /**
     * @return array|array[]
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['access'] = [
            'class' => AccessControl::class,
            'ruleConfig' => ['class' => AccessRule::class],
            'only' => ['create', 'update', 'delete', 'view', 'index'],
            'rules' => [
                [
                    'actions' => ['create', 'update', 'delete', 'view'],
                    'allow' => true,
                    'roles' => [User::ROLE_ADMIN],
                ],
                [
                    'actions' => ['index'],
                    'allow' => true,
                    'roles' => [User::ROLE_USER, User::ROLE_ADMIN],
                ],
            ],
        ];
        return $behaviors;
    }

    /**
     * @return string[]
     */
    public function actionIndex(): array
    {
        return ['message' => 'Api works'];
    }
}
