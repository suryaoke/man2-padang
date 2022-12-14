<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "notif1".
 *
 * @property int $id
 * @property int $id_sm
 * @property string $created_at
 * @property string $tujuan
 * @property string $isi
 * @property string $header
 * @property string $status
 * @property int $id_pengirim
 * @property string $
 *
 * @property Suratmasuk $sm
 */
class Notif1 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'notif1';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm', 'created_at', 'tujuan', 'isi', 'header', 'status', 'id_pengirim'], 'required'],
            [['id_sm', 'id_pengirim'], 'integer'],
            [['created_at'], 'safe'],
            [['tujuan', 'isi', 'header', 'status'], 'string', 'max' => 200],
            [['id_sm'], 'exist', 'skipOnError' => true, 'targetClass' => Suratmasuk::class, 'targetAttribute' => ['id_sm' => 'id_sm']],
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
            'created_at' => 'Created At',
            'tujuan' => 'Tujuan',
            'isi' => 'Isi',
            'header' => 'Header',
            'status' => 'Status',
            'id_pengirim' => 'Id Pengirim',

        ];
    }

    /**
     * Gets query for [[Sm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSm()
    {
        return $this->hasOne(Suratmasuk::class, ['id_sm' => 'id_sm']);
    }
}
