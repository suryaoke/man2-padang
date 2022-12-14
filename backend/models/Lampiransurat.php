<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lampiransurat".
 *
 * @property int $id
 * @property int $id_informasi
 * @property string $file
 */
class Lampiransurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lampiransurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_informasi', 'file'], 'required'],
            [['id_informasi'], 'integer'],
            [['file'], 'file',
            'extensions' => 'pdf'],
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
            'file' => 'File',
        ];
    }
}
