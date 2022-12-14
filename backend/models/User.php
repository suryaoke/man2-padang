<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string|null $verification_token
 * @property string $jabatan
 * @property string $role
 * @property string $foto
 *
 * @property Smdisposisi[] $smdisposisis
 * @property Suratmasuk[] $suratmasuks
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'created_at', 'updated_at', 'jabatan', 'role', 'foto' ,'nama','file'], 'required'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['jabatan', 'role', 'foto','nama','file','email'], 'string', 'max' => 200],
            [['username'], 'unique'],
            [['password_reset_token'], 'unique'],
            [
                ['foto'], 'file',
                'extensions' => ['png','jpg','jpeg','jfif']
            ],
            [
                ['file'], 'file',
                'extensions' => ['png','jpg','jpeg']
            ],
       ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'jabatan' => 'Jabatan',
            'role' => 'Role',
            'foto' => 'Foto',
            'email' => 'email'
        ];
    }

    /**
     * Gets query for [[Smdisposisis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSmdisposisis()
    {
        return $this->hasMany(Smdisposisi::className(), ['id_pengirim' => 'id']);
    }

    /**
     * Gets query for [[Suratmasuks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSuratmasuks()
    {
        return $this->hasMany(Suratmasuk::className(), ['tujuan' => 'id']);
    }
}
