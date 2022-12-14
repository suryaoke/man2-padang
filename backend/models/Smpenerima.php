<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smpenerima".
 *
 * @property int $id
 * @property int $id_sm
 * @property int $id_pengirim
 * @property int $id_penerima
 * @property string $status
 */
class Smpenerima extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smpenerima';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm', 'id_pengirim', 'id_penerima', 'status'], 'required'],
            [['id_sm', 'id_pengirim', 'id_penerima'], 'integer'],
            [['status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sm' => 'Id Sm',
            'id_pengirim' => 'Id Pengirim',
            'id_penerima' => 'Id Penerima',
            'status' => 'Status',
        ];
    }
}
