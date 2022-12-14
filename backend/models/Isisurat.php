<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "isisurat".
 *
 * @property int $id
 * @property int $id_informasi
 * @property string $isi
 */
class Isisurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'isisurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi', 'isi'], 'required'],
            [['id_informasi'], 'integer'],
            [['isi'], 'string'],
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
            'isi' => 'Isi',
        ];
    }
}
