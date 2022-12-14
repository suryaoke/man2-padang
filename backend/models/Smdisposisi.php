<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smdisposisi".
 *
 * @property int $id_sm_disposisi
 * @property int $id_sm
 * @property int $id_pengirim
 * @property string $isi
 * @property string $kirim_at
 * @property string $status
 * @property int $id_penerima
 *
 * @property User $pengirim
 * @property Suratmasuk $sm
 */
class Smdisposisi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smdisposisi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm', 'id_pengirim', 'isi', 'kirim_at', 'status', 'id_penerima'], 'required'],
            [['id_sm', 'id_pengirim', 'id_penerima'], 'integer'],
            [['isi'], 'string'],
            [['kirim_at'], 'safe'],
            [['status'], 'string', 'max' => 200],
            [['id_sm'], 'exist', 'skipOnError' => true, 'targetClass' => Suratmasuk::className(), 'targetAttribute' => ['id_sm' => 'id_sm']],
            [['id_pengirim'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_pengirim' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sm_disposisi' => 'Id Sm Disposisi',
            'id_sm' => 'Id Sm',
            'id_pengirim' => 'Id Pengirim',
            'isi' => 'Isi',
            'kirim_at' => 'Kirim At',
            'status' => 'Status',
            'id_penerima' => 'Id Penerima',
        ];
    }

    /**
     * Gets query for [[Pengirim]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPengirim()
    {
        return $this->hasOne(User::className(), ['id' => 'id_pengirim']);
    }

    /**
     * Gets query for [[Sm]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSm()
    {
        return $this->hasOne(Suratmasuk::className(), ['id_sm' => 'id_sm']);
    }
}
