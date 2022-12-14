<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tujuansurat".
 *
 * @property int $id
 * @property int $id_informasi_surat
 * @property string $id_user
 * @property string $status
 */
class Tujuansurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tujuansurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi_surat', 'id_user', 'status'], 'required'],
            [['id_informasi_surat'], 'integer'],
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
            'id_informasi_surat' => 'Id Informasi Surat',
            'id_user' => 'Id User',
            'status' => 'Status',
        ];
    }
}
