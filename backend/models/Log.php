<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "log".
 *
 * @property int $id
 * @property int $id_user
 * @property string $perihal
 * @property string $date
 * @property string $no_surat
 */
class Log extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'log';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'perihal', 'date', 'no_surat'], 'required'],
            [['id_user'], 'integer'],
            [['perihal', 'date', 'no_surat'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'perihal' => 'Perihal',
            'date' => 'Date',
            'no_surat' => 'No Surat',
        ];
    }
}
