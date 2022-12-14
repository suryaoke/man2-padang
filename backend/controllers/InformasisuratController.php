<?php

namespace backend\controllers;

use backend\models\Asalsurat;
use backend\models\Informasisurat;
use backend\models\InformasisuratSearch;
use backend\models\Isisurat;
use backend\models\Lampiransurat;
use backend\models\Log;
use backend\models\Naskahdinas;
use backend\models\Notif1;
use backend\models\Notif2;
use backend\models\Pembuatsurat;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\Tandatangan;
use backend\models\Tembusansurat;
use backend\models\Tujuansurat;
use backend\models\User;
use backend\models\Verifikasi;
use GuzzleHttp\Psr7\InflateStream;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * InformasisuratController implements the CRUD actions for Informasisurat model.
 */
class InformasisuratController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    public function beforeAction($action)
    {
        if ($action->id == 'acc-ttd') {
            $this->enableCsrfValidation = false;
        }

        return parent::beforeAction($action);
    }
    // public function beforeAction($action)
    // {
    //     if ($action->id == 'acc-ttd') {
    //         $this->enableCsrfValidation = false;
    //     }

    //     return parent::beforeAction($action);
    // }
    /**
     * Lists all Informasisurat models.
     *
     * @return string
     */
    public function actionIndex()
    {

        $searchModel = new InformasisuratSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        $informasisurat = Informasisurat::find()->all();
        $pembuat = Pembuatsurat::find()->where(['id_user' => Yii::$app->user->identity->id])->orderBy('id DESC')->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'informasisurat' => $informasisurat,
            'pembuat' => $pembuat,

        ]);
    }

    public function actionReportsb()
    {
        $searchModel = new InformasisuratSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
  
        return $this->render('reportsb', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        
        ]);
    }

    public function actionData()
    {

        $searchModel = new InformasisuratSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $informasisurat = Informasisurat::find()->orderBy('id DESC')->all();

        return $this->render('data', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'informasisurat' => $informasisurat,

        ]);
    }


    /**
     * Displays a single Informasisurat model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Informasisurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Informasisurat();
        $asal = Asalsurat::find()->all();
        $naskah = Naskahdinas::find()->all();
        $naskah1 = Naskahdinas::find()->where(['nama' => "Surat Kosong"])->all();
        $update = Tujuansurat::find()->where(['id_informasi_surat' => $model->id])->one();
        $model2 = new Pembuatsurat();
        $model3 = new Isisurat();
        $model4 = new Notif2();
        $model5 = new Verifikasi();
        $kondisi = "1";
        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model->id])->orderBy('id DESC')->one();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                // informasi Surat //
                $model->status = "diperiksa";
                $model->kirim_at = date('Y-m-d H:i:s');
                $model->save();

                // Pembuat Surat //
                $model2->id_informasi = $model->id;
                $model2->id_user = Yii::$app->user->identity->id;
                $model2->tanggal =  date('Y-m-d H:i:s');
                $model2->save();

                //  Isi Surat // 
                $model3->id_informasi = $model->id;
                $data1 =  Naskahdinas::find()->where(['id' => $model['id_naskah_dinas']])->one();
                $model3->isi = $data1->body;
                $model3->save();


                if (Yii::$app->user->identity->role == "tu" || Yii::$app->user->identity->role == "admin") {
                    // Notifikasi verificator//
                    $user = User::find()->where(['role' =>  Yii::$app->user->identity->role = "Verificator"])->one();
                    $model4->id_sk = $model->id;
                    $model4->created_at =  date('Y-m-d H:i:s');
                    $model4->tujuan = $user->id;
                    $model4->isi = $model->perihal;
                    $model4->header = "Surat Baru";
                    $model4->status = "belum dibaca";
                    $model4->id_pengirim = Yii::$app->user->identity->id;
                    $model4->kategori = 1;
                    $model4->save();

                    // Verficator //
                    $model5->id_informasi = $model->id;
                    $model5->id_user = $user->id;
                    $model5->status = "diperiksa";
                    $model5->ket = "-";
                    $model5->save();
                }
                //log //
                $log = new Log();
                $log->id_user =  Yii::$app->user->identity->id;
                $log->perihal = "Buat Surat Baru";
                $log->date = Date("Y-m-d H:i:s");
                $log->no_surat = $model->no_surat;
                $log->save();


                return $this->redirect(['tujuansurat', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        return $this->render('create', [

            'model' => $model,
            'asal' =>  $asal,
            'naskah' => $naskah,
            'naskah1' => $naskah1,
            'update' => $update,
            'model2' => $model2,
            'model3' => $model3,
            'model4' => $model4,
            'model5' => $model5,
            'kondisi' => $kondisi,
            'dataverifikasi' =>  $dataverifikasi,
        ]);
    }

    /**
     * Updates an existing Informasisurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $asal = Asalsurat::find()->all();
        $naskah = Naskahdinas::find()->all();
        $update = Tujuansurat::find()->where(['id_informasi_surat' => $model->id])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model->id])->one();
        $naskah1 = Naskahdinas::find()->where(['nama' => "Surat Kosong"])->all();
        $kondisi = "2";
        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model->id])->orderBy('id DESC')->one();


        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'asal' => $asal,
            'naskah' => $naskah,
            'naskah1' => $naskah1,
            'update' => $update,
            'tanda' => $tanda,
            'kondisi' => $kondisi,
            'dataverifikasi' =>  $dataverifikasi,

        ]);
    }


    /**
     * Deletes an existing Informasisurat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {

        $model0 = $this->findModel($id);
        $info = Informasisurat::find()->where(['id' => $id])->one();
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $id])->one();
        $isi = Isisurat::find()->where(['id_informasi' => $id])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $id])->one();
        $tandatangan = Tandatangan::find()->where(['id_informasi' => $id])->one();
        $notif = Notif2::find()->where(['id_pengirim' => $id])->one();
        $lampiran = Lampiransurat::find()->where(['id_informasi' => $id])->one();
        $tembusan = Tembusansurat::find()->where(['id_informasi' => $id])->one();
        $verifikasi = Verifikasi::find()->where(['id_informasi' => $id])->one();
      
      
      
      

        if ($info  != null) {
            $info->delete();
        }

        if ($tujuan  != null) {
            $tujuan->delete();
        }
        if ($isi  != null) {
            $isi->delete();
        }
        if ($pembuat  != null) {
            $pembuat->delete();
        }
        if ($tandatangan  != null) {
            $tandatangan->delete();
        }
        if ($notif  != null) {
            $notif->delete();
        }
        if ($lampiran  != null) {
            $lampiran->delete();
        }
        if ($tembusan  != null) {
            $tembusan->delete();
        }
        if ($verifikasi  != null) {
            $verifikasi->delete();
        }

        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Hapus Surat Baru";
        $log->date = Date("Y-m-d H:i:s");
        $log->no_surat = $model0->no_surat;
        $log->save();

        return $this->redirect(['/']);
    }

    /**
     * Finds the Informasisurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Informasisurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Informasisurat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionTujuansurat($id)
    {
        $model0 = $this->findModel($id);
        $model = new Tujuansurat();
        $isi = Isisurat::find()->where(['id_informasi' => $model0->id])->one();

        $data = Informasisurat::find()->where(['id' => $model0->id])->one();
        $model1 = new Isisurat();
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id])->all();

        $tanda = Tandatangan::find()->where(['id_informasi' => $model0->id])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model0->id])->one();
        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model0->id])->orderBy('id DESC')->one();

        if ($model->load(Yii::$app->request->post())) {

            $model->save();

            $carisurat = Isisurat::find()->where(['id_informasi' => $model0->id])->one();
            if (strpos($carisurat->isi, '{tanggal_surat}')) {
                $isi = str_replace('{tanggal_surat}', $data->tanggal_surat, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save();
            }
            if (strpos($carisurat->isi, '{no_surat}')) {
                $isi = str_replace('{no_surat}', $data->no_surat, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save();
            }

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Buat Tujuan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $model0->no_surat;
            $log->no_surat = $model0->no_surat;
            $log->save();

            return $this->redirect(['tujuansurat', 'id' => $model0->id]);
        }

        return $this->render('tujuansurat', [
            'model0' => $model0,
            'model' => $model,
            'model1' => $model1,
            'tujuan' => $tujuan,
            'isi' =>  $isi,
            'tanda' => $tanda,
            'pembuat' => $pembuat,
            'dataverifikasi' => $dataverifikasi,
        ]);
    }


    public function actionDelete2($del)
    {
        $query = Tujuansurat::findOne($del);

        $query->delete();

        $data = Informasisurat::find()->where(['id' => $query->id_informasi_surat])->one();
        return $this->redirect(['tujuansurat', 'id' => $data->id]);
    }



    public function actionTtd($id)
    {
        $model1 = $this->findModel($id);

        $datainformasi = Informasisurat::find()->where(['id' => $model1->id])->all();
        $dataisi = Isisurat::find()->where(['id_informasi' => $model1->id])->one();
        $datainfo = Informasisurat::find()->where(['id' => $model1->id])->one();
        $datatandatangan  = Tandatangan::find()->where(['id_informasi' => $model1->id])->all();
        $tanda  = Tandatangan::find()->where(['id_informasi' => $model1->id])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model1->id])->one();

        if ($this->request->isPost  && $model1->load($this->request->post())) {


            $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();


            $carisurat = Isisurat::find()->where(['id_informasi' => $model1->id])->one();
            $data = " <img src='/upload/tandatangan/$user->file' style=' width: 120px; height: 100px;'/> ";

            if ($user["file"] == "") {
                Yii::$app->session->setFlash('warning', "Silahkan Tambahkan Tanda Tangan Anda!!");
                return $this->redirect(['user/index']);
            } else {

                if (strpos($carisurat->isi, '{ttd}')) {
                    $isi = str_replace('{ttd}', $data, $carisurat->isi);
                    $carisurat->isi = $isi;
                    $carisurat->save();
                } else {
                    echo "Silahkan Tambahkan {ttd} Di Form Surat  ";

                    die;
                }
            }
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Tanda Tangan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $model1->no_surat;
            $log->save();

            $model1->save();

            return $this->redirect(['informasisurat/ttd', 'id' => $model1->id]);
        }

        return $this->render('ttd', [


            'model1' => $model1,

            'datainformasi' => $datainformasi,
            'dataisi' => $dataisi,
            'datainfo' => $datainfo,
            'datatandatangan' => $datatandatangan,
            'tanda' => $tanda,
            'pembuat' => $pembuat,


        ]);
    }


    public function actionLangsung($id)
    {
        $model1 = $this->findModel($id);
        $data = "";


        $carisurat = Isisurat::find()->where(['id_informasi' => $model1->id])->one();
        if (strpos($carisurat->isi, '{ttd}')) {
            $isi = str_replace('{ttd}', $data, $carisurat->isi);
            $carisurat->isi = $isi;
            $carisurat->save();
        } else {
            echo "Silahkan Tambahkan {ttd} Di Form Surat  ";

            die;
        }
        $model1->status = "ditandatangan";
        $model1->save();
        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Tanda Tangan Surat Baru";
        $log->date = Date("Y-m-d H:i:s");
        $log->no_surat = $model1->no_surat;
        $log->save();


        return $this->redirect(['informasisurat/ttd', 'id' => $model1->id]);
        return $this->render('langsung', [
            'model1' => $model1,




        ]);
    }

    public function actionAccTtd($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            $img = Yii::$app->request->post('img');
            $gambar =  '<img src=data:' . $img . ' style="width: 200px; height: 60px;">';
            $carisurat = Isisurat::find()->where(['id_informasi' => $model->id])->one();

            if (strpos($carisurat->isi, '{ttd}')) {

                $isi = str_replace('{ttd}', $gambar, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save(false);
                $model->status = "ditandatangan";
                $model->save();
            } else {
                echo "Silahkan Tambahkan {ttd} Di Form Surat  ";

                die;
            }

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Tanda Tangan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $model->no_surat;
            $log->save();
            return $this->redirect(['informasisurat/ttd', 'id' => $model->id]);
        }
        return $this->render('acc-ttd', [
            'model' => $model,

        ]);
    }

    public function actionSuratmasukdalam($id)
    {
        $model0 = $this->findModel($id);
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id])->all();


        foreach ($tujuan as $row) {
            $info = Informasisurat::find()->where(['id' => $row->id_informasi_surat])->one();
            $isi = Isisurat::find()->where(['id_informasi' => $row->id_informasi_surat])->one();

            $model1 = new Suratmasuk();
            $model1->asal_surat =  "Dalam Sekolah";
            $model1->perihal = $info->perihal;
            $model1->tanggal_surat =  $info->tanggal_surat;
            $model1->nama = Yii::$app->user->identity->nama;
            $model1->no_surat =   $info->no_surat;
            $model1->file2 =  $isi->isi;
            $model1->file =  '0';
            $model1->tujuan = $row->id_user;
            $model1->status = "belum dibaca";
            $model1->kirim_at = date('Y-m-d H:i:s');
            $model1->save(false);

            $model = new Smpenerima();
            $model->id_sm = $model1->id_sm;
            $model->id_pengirim = Yii::$app->user->identity->id;
            $model->id_penerima = $row->id_user;
            $model->status = "belum dibaca";
            $model->save();

            $model2 = new Notif1();
            $model2->id_sm = $model1->id_sm;
            $model2->id_pengirim = Yii::$app->user->identity->id;
            $model2->tujuan = $row->id_user;
            $model2->status = "belum dibaca";
            $model2->header = "Surat Masuk";
            $model2->isi = $info->perihal;
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->save();
          
          
           $model3 = new Smterkirim();
            $model3->id_sm = $model->id_sm;
            $model3->id_pengirim = Yii::$app->user->identity->id;
            $model3->save();

            $info->status = "dikirim";
            $info->save();

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Kirim Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $info->no_surat;
            $log->save();
        }

        return $this->redirect(['informasisurat/index']);
    }
}
