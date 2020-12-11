<?php
namespace app\models;

use yii\db\ActiveRecord;
use yii\db\IntegrityException;
use yii\web\BadRequestHttpException;

/**
 * Class BaseModel
 * @package app\models
 */
class BaseModel extends ActiveRecord
{
    /**
     * @return false|int
     * @throws BadRequestHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function delete()
    {
        try {
            return parent::delete();
        }
        catch (IntegrityException $e) {
            throw new BadRequestHttpException('There is related data. Unable to delete.');
        }
    }
}