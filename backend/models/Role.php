<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "role".
 *
 * @property int $id
 * @property string $nama
 * @property int $level
 */
class Role extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'role';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'level'], 'required'],
            [['level'], 'integer'],
            [['nama'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama' => 'Nama',
            'level' => 'Level',
        ];
    }
}
