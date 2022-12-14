<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tanda".
 *
 * @property int $id
 * @property int $id_informasi
 */
class Tanda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tanda';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi'], 'required'],
            [['id_informasi'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_informasi' => 'Id Informasi',
        ];
    }
}
