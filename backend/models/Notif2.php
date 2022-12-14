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
 * @property int $kategori
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
            [['id_sk', 'created_at', 'tujuan', 'isi', 'header', 'status', 'id_pengirim', 'kategori'], 'required'],
            [['id_sk', 'tujuan', 'id_pengirim', 'kategori'], 'integer'],
            [['created_at'], 'safe'],
            [['isi', 'header', 'status'], 'string', 'max' => 200],
            [['id_sk'], 'exist', 'skipOnError' => true, 'targetClass' => Informasisurat::class, 'targetAttribute' => ['id_sk' => 'id']],
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
            'kategori' => 'Kategori',
        ];
    }

    /**
     * Gets query for [[Sk]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSk()
    {
        return $this->hasOne(Informasisurat::class, ['id' => 'id_sk']);
    }
}
