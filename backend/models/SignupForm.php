<?php

namespace backend\models;
use common\models\User;
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
 */
class SignupForm extends \yii\db\ActiveRecord
{
    public $username;
    public $password;
    public $email;

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
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

           
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],

            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
            
            [['jabatan', 'role', 'foto', 'nama'], 'string', 'max' => 200],
           
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

    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        
        $user = new User();
        $user->username = $this->username;
        $user->jabatan = $this->jabatan;
        $user->email = $this->email;
        $user->role = $this->role;
        $user->nama = $this->nama;
        $user->setPassword($this->password);
        $user->generateAuthKey();

        
       

        return $user->save() ;
    }

    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Account registration at ' . Yii::$app->name)
            ->send();
    }
}
