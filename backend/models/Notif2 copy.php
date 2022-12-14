<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notif2".
 *
 * @property int $id
 * @property int $id_sk
 * @property string $created_at
 * @property int $tujuan
 * @property string $isi
 * @property string $header
 * @property string $status
 * @property int $id_pengirim
 *
 * @property Informasisurat $sk
 */
class Notif2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notif2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
          
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_sk' => 'Id Sk',
            'created_at' => 'Created At',
            'tujuan' => 'Tujuan',
            'isi' => 'Isi',
            'header' => 'Header',
            'status' => 'Status',
            'id_pengirim' => 'Id Pengirim',
        ];
    }

    /**
     * Gets query for [[Sk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSk()
    {
        return $this->hasOne(Informasisurat::className(), ['id' => 'id_sk']);
    }
}
