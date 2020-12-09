<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "characteristic".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $max_points
 *
 * @property CharacteristicProgress[] $characteristicProgresses
 * @property Quality[] $qualities
 */
class Characteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['max_points'], 'integer'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'max_points' => 'Max Points',
        ];
    }

    /**
     * Gets query for [[CharacteristicProgresses]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristicProgresses()
    {
        return $this->hasMany(CharacteristicProgress::className(), ['characteristic_id' => 'id']);
    }

    /**
     * Gets query for [[Qualities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQualities()
    {
        return $this->hasMany(Quality::className(), ['characteristic_id' => 'id']);
    }
}
