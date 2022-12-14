<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "naskahdinas".
 *
 * @property int $id
 * @property string $nama
 * @property string $status
 * @property string $body
 */
class Naskahdinas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'naskahdinas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'status', 'body'], 'required'],
            [['body'], 'string'],
            [['nama', 'status'], 'string', 'max' => 200],
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
            'status' => 'Status',
            'body' => 'Body',
        ];
    }
}
