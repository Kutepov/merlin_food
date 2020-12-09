<?php

namespace app\modules\api;

use yii\base\Module as BaseModule;
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

        \Yii::configure(\Yii::$app, [
            'components' => [
                'response' => [
                    'class' => 'yii\web\Response',
                    'on beforeSend' => function ($event) {
                        $response = $event->sender;
                        if ($response->data !== null) {
                            $response->data = [
                                'success' => $response->isSuccessful,
                                'data' => $response->data,
                            ];
                        }
                    },
                ],
            ]
        ]);
    }
}
