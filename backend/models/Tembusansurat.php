<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tembusansurat".
 *
 * @property int $id
 * @property int $id_informasi
 * @property string $id_user
 * @property string $status
 */
class Tembusansurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tembusansurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi', 'id_user', 'status'], 'required'],
            [['id_informasi'], 'integer'],
            [['id_user', 'status'], 'string', 'max' => 200],
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
            'id_user' => 'Id User',
            'status' => 'Status',
        ];
    }
}
