<?php

namespace app\models\forms;

use yii\base\Model;


/**
 * Class OpenNewRecommendation
 * @package app\models\forms
 *
 * @property string $user_id
 * @property string $person_id
 * @property string $trans_id
 * @property array $payload
 */
class OpenNewRecommendation extends Model
{
    public $user_id;
    public $person_id;
    public $trans_id;
    public $payload;

    public function rules()
    {
        return [
            [['user_id', 'person_id', 'trans_id', 'payload'], 'required'],
            [['payload'], 'validatePayload'],
        ];
    }

    public function validatePayload($attribute, $params, $validator)
    {
        if (!isset($this->$attribute['quality_id']) || !isset($this->$attribute['person_type'])) {
            $this->addError($attribute, 'Payload field must contain fields: quality_id and person_type');
        }
    }
}
