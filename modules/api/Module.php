<?php

namespace app\modules\api;

use Yii;
use app\models\User;
use yii\base\Module as BaseModule;
use yii\web\UnauthorizedHttpException;

/**
 * api module definition class
 */
class Module extends BaseModule
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\api\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::$app->user->enableSession = false;
        \Yii::configure(\Yii::$app, [
            'components' => [
                'response' => [
                    'class' => 'yii\web\Response',
                    /*'on beforeSend' => function ($event) {
                        $response = $event->sender;
                        if ($response->data !== null) {
                            unset($response->data['code']);
                            unset($response->data['status']);

                            $response->data = [
                                'success' => $response->isSuccessful,
                                'data' => $response->data,
                            ];
                        }
                    },*/
                ],
            ]
        ]);
    }

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => \sizeg\jwt\JwtHttpBearerAuth::class,
        ];

        return $behaviors;
    }
}
