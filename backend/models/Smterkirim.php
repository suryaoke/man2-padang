<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "smterkirim".
 *
 * @property int $id
 * @property int $id_sm
 * @property int $id_pengirim
 *
 * @property Suratmasuk $sm
 */
class Smterkirim extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'smterkirim';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sm', 'id_pengirim'], 'required'],
            [['id_sm', 'id_pengirim'], 'integer'],
            [['id_sm'], 'exist', 'skipOnError' => true, 'targetClass' => Suratmasuk::className(), 'targetAttribute' => ['id_sm' => 'id_sm']],
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
        ];
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
