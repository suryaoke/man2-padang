<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "pembuatsurat".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_informasi
 * @property string $tanggal
 */
class Pembuatsurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pembuatsurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_informasi', 'tanggal'], 'required'],
            [['id_user', 'id_informasi'], 'integer'],
            [['tanggal'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_informasi' => 'Id Informasi',
            'tanggal' => 'Tanggal',
        ];
    }
}
