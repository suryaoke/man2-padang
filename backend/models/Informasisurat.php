<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "informasisurat".
 *
 * @property int $id
 * @property string $tujuan_surat
 * @property string $perihal
 * @property int $id_naskah_dinas
 * @property string $nomor_agenda
 * @property string $tanggal_surat
 * @property string $no_surat
 * @property string $status
 * @property string $kirim_at
 *
 * @property Isisurat[] $isisurats
 * @property Notif2[] $notif2s
 * @property Pembuatsurat[] $pembuatsurats
 * @property Tandatangan[] $tandatangans
 * @property Tujuansurat[] $tujuansurats
 * @property Verifikasi[] $verifikasis
 */
class Informasisurat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informasisurat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tujuan_surat', 'perihal', 'id_naskah_dinas', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status', 'kirim_at'], 'required'],
            [['id_naskah_dinas'], 'integer'],
            [['kirim_at'], 'safe'],
            [['tujuan_surat', 'perihal', 'nomor_agenda', 'tanggal_surat', 'no_surat', 'status'], 'string', 'max' => 200],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tujuan_surat' => 'Tujuan Surat',
            'perihal' => 'Perihal',
            'id_naskah_dinas' => 'Id Naskah Dinas',
            'nomor_agenda' => 'Nomor Agenda',
            'tanggal_surat' => 'Tanggal Surat',
            'no_surat' => 'No Surat',
            'status' => 'Status',
            'kirim_at' => 'Kirim At',
        ];
    }

    /**
     * Gets query for [[Isisurats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIsisurats()
    {
        return $this->hasMany(Isisurat::class, ['id_informasi' => 'id']);
    }

    /**
     * Gets query for [[Notif2s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNotif2s()
    {
        return $this->hasMany(Notif2::class, ['id_sk' => 'id']);
    }

    /**
     * Gets query for [[Pembuatsurats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPembuatsurats()
    {
        return $this->hasMany(Pembuatsurat::class, ['id_informasi' => 'id']);
    }

    /**
     * Gets query for [[Tandatangans]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTandatangans()
    {
        return $this->hasMany(Tandatangan::class, ['id_informasi' => 'id']);
    }

    /**
     * Gets query for [[Tujuansurats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTujuansurats()
    {
        return $this->hasMany(Tujuansurat::class, ['id_informasi_surat' => 'id']);
    }

    /**
     * Gets query for [[Verifikasis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVerifikasis()
    {
        return $this->hasMany(Verifikasi::class, ['id_informasi' => 'id']);
    }
}
