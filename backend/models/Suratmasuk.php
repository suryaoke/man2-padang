<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "suratmasuk".
 *
 * @property int $id_sm
 * @property string $asal_surat
 * @property string $perihal
 * @property string $tanggal_surat
 * @property string $nama
 * @property string $no_surat
 * @property string $file
 * @property int $tujuan
 * @property string $status diproses
 * @property string $kirim_at
 * @property string $file2
 *
 * @property Notif1[] $notif1s
 * @property Smdisposisi[] $smdisposisis
 * @property Smpenerima[] $smpenerimas
 * @property Smterkirim[] $smterkirims
 */
class Suratmasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'suratmasuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['asal_surat', 'perihal', 'tanggal_surat', 'nama', 'no_surat', 'file', 'tujuan', 'status', 'kirim_at'], 'required'],
            [['tujuan'], 'integer'],
            [['kirim_at','file2'], 'safe'],
    
            [['asal_surat', 'perihal', 'tanggal_surat', 'nama', 'no_surat', 'file', 'status'], 'string', 'max' => 200],
            [
                ['file'], 'file',
                'extensions' => 'pdf'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_sm' => 'Id Sm',
            'asal_surat' => 'Asal Surat',
            'perihal' => 'Perihal',
            'tanggal_surat' => 'Tanggal Surat',
            'nama' => 'Nama',
            'no_surat' => 'No Surat',
            'file' => 'File',
            'tujuan' => 'Tujuan',
            'status' => 'Status',
            'kirim_at' => 'Kirim At',
            'file2' => 'File2',
        ];
    }

    /**
     * Gets query for [[Notif1s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotif1s()
    {
        return $this->hasMany(Notif1::class, ['id_sm' => 'id_sm']);
    }

    /**
     * Gets query for [[Smdisposisis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSmdisposisis()
    {
        return $this->hasMany(Smdisposisi::class, ['id_sm' => 'id_sm']);
    }

    /**
     * Gets query for [[Smpenerimas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSmpenerimas()
    {
        return $this->hasMany(Smpenerima::class, ['id_sm' => 'id_sm']);
    }

    /**
     * Gets query for [[Smterkirims]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSmterkirims()
    {
        return $this->hasMany(Smterkirim::class, ['id_sm' => 'id_sm']);
    }
}
