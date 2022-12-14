<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "tandatangan".
 *
 * @property int $id
 * @property int $id_informasi
 * @property int $id_user
 * @property string $status
 * @property string $ket
 * @property string $statusnotif
 *
 * @property Informasisurat $informasi
 */
class Tandatangan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tandatangan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi', 'id_user', 'status', 'ket', 'statusnotif'], 'required'],
            [['id_informasi', 'id_user'], 'integer'],
            [['ket'], 'string'],
            [['status', 'statusnotif'], 'string', 'max' => 200],
            [['id_informasi'], 'exist', 'skipOnError' => true, 'targetClass' => Informasisurat::class, 'targetAttribute' => ['id_informasi' => 'id']],
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
            'ket' => 'Ket',
            'statusnotif' => 'Statusnotif',
        ];
    }

    /**
     * Gets query for [[Informasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInformasi()
    {
        return $this->hasOne(Informasisurat::class, ['id' => 'id_informasi']);
    }
}
