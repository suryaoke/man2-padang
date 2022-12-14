<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Log;
use backend\models\Notif1;
use backend\models\Notif2;
use backend\models\Tandatangan;
use backend\models\SearchTandatangan;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\Tujuansurat;
use backend\models\User;
use backend\models\Verifikasi;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TandatanganController implements the CRUD actions for Tandatangan model.
 */
class TandatanganController extends Controller
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
    /**
     * Lists all Tandatangan models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchTandatangan();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $tanda = Tandatangan::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'tanda' =>  $tanda,
        ]);
    }

    /**
     * Displays a single Tandatangan model.
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
     * Creates a new Tandatangan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tandatangan();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Tandatangan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $datainformasi = Informasisurat::find()->where(['id' => $model->id_informasi])->all();
        $isi = Isisurat::find()->where(['id_informasi' => $model->id_informasi])->one();
        $notif = Notif2::find()->where(['id_sk' => $model->id_informasi ,'tujuan' => Yii::$app->user->identity->id])->one();

        $notif->status = "dibaca";
        $notif->save();
        $model->statusnotif = "dibaca";
        $model->save();




        if ($this->request->isPost  && $model->load($this->request->post()) && $model->load($this->request->post())) {


            
            $user = User::find()->where(['id' => Yii::$app->user->identity->id])->one();
            $carisurat = Isisurat::find()->where(['id_informasi' => $model->id_informasi])->one();
            $data = " <img src='/upload/tandatangan/$user->file' style=' width: 120px; height: 100px;'/> ";

            if ($user["file"] == "") {
                Yii::$app->session->setFlash('warning', "Silahkan Tambahkan Tanda Tangan Anda!!");
                return $this->redirect(['user/index']);
            } else {


            if (strpos($carisurat->isi, '{ttd}')) {
                $isi = str_replace('{ttd}', $data, $carisurat->isi);
                $carisurat->isi = $isi;
                $carisurat->save();
            }else {
                echo "Silahkan Tambahkan {ttd} Di Form Surat  ";

                die;
            }
        }


            $data = Informasisurat::find()->where(['id' => $model->id_informasi])->one();
            $data->status = "ditandatangan";
            $data->save();
            $model->save();
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Tanda Tangan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $data->no_surat;
            $log->save();


            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'datainformasi' => $datainformasi,
            'isi' => $isi,
            'notif' => $notif,




        ]);
    }

    /**
     * Deletes an existing Tandatangan model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Tandatangan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tandatangan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tandatangan::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    public function actionVerifikasi($id)
    {

        $model1 = $this->findModel($id);
        $model = new Verifikasi();
        $model2 = Tandatangan::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $model3 = Notif2::find()->where(['id_sk' => $model1->id_informasi])->one();
        $datainformasi = Informasisurat::find()->where(['id' => $model1->id_informasi])->one();
        $tujuan =  Tujuansurat::find()->where(['id_informasi_surat' => $model1->id_informasi])->one();
        $isi = Isisurat::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $dataverifikasi  = Verifikasi::find()->where(['id_informasi' => $model1->id_informasi])->all();
        if ($model->load(Yii::$app->request->post()) && $model2->load(Yii::$app->request->post())) {

            $model->save();
            $model2->save();
            $model3->created_at = date('Y-m-d H:i:s');
            $model3->status = "belum dibaca";
            $model3->save();
            return $this->redirect(['tandatangan/verifikasi', 'id' => $model1->id]);
        }

        return $this->render('Verifikasi', [

            'model' => $model,
            'model1' => $model1,
            'model2' => $model2,
            'model3' => $model3,
            'datainformasi' => $datainformasi,
            'tujuan' => $tujuan,
            'isi' => $isi,
            'dataverifikasi' => $dataverifikasi,

        ]);
    }

    public function actionAccTtd($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            $img = Yii::$app->request->post('img');
            $gambar =  '<img src=data:' . $img . ' style="width: 200px; height: 60px;">';
            $carisurat = Isisurat::find()->where(['id_informasi' => $model->id_informasi])->one();

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

            $data = Informasisurat::find()->where(['id' => $model->id_informasi])->one();
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Tanda Tangan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $data->no_surat;
            $log->save();

            return $this->redirect(['update', 'id' => $model->id]);
        }
        return $this->render('acc-ttd', [
            'model' => $model,

        ]);
    }

    public function actionKirim($id)
    {

        $model = $this->findModel($id);
        $info = Informasisurat::find()->where(['id' => $model->id_informasi])->one();

        $model->status = "diterima";
        $model->save();
        $info->status = "diterima";
        $info->save();

        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Kirim Surat Baru";
        $log->date = Date("Y-m-d H:i:s");
        $log->no_surat = $info->no_surat;
        $log->save();
        return $this->redirect(['index']);

        return $this->render('kirim', [
            'model' => $model,
            'info' => $info,

        ]);
    }

    public function actionSuratmasuk($id)
    {
        $model0 = $this->findModel($id);
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id_informasi])->all();


        foreach ($tujuan as $row) {
            $info = Informasisurat::find()->where(['id' => $row->id_informasi_surat])->one();
            $isi = Isisurat::find()->where(['id_informasi' => $row->id_informasi_surat])->one();
            $verifikasi = Verifikasi::find()->where(['id_informasi' => $row->id_informasi_surat])->orderBy('id DESC')->one();
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
            $model2->isi = $info->perihal;
            $model2->status = "belum dibaca";
            $model2->header = "Surat Masuk";
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->save();

            $model3 = new Smterkirim();
            $model3->id_sm = $model1->id_sm;
            $model3->id_pengirim = Yii::$app->user->identity->id;
            $model3->save();

            $model0->status = "dikirim";
            $model0->save();
            $verifikasi->status = "dikirim";
            $verifikasi->save();
        }

        return $this->redirect(['verifikasi', 'id' => $id]);
    }


    public function actionSuratmasukk($id)
    {
        $model0 = $this->findModel($id);
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id_informasi])->all();


        foreach ($tujuan as $row) {

            $verifikasi = Verifikasi::find()->where(['id_informasi' => $row->id_informasi_surat])->orderBy('id DESC')->one();


            $model0->status = "dikirim";
            $model0->save();
            $verifikasi->status = "dikirim";
            $verifikasi->save();
        }

        return $this->redirect(['verifikasi', 'id' => $id]);
    }



    public function actionLangsung($id)
    {
        $model = $this->findModel($id);
        $model->status = "ditandatangan";
        $model->save();
        $data = "";


        $carisurat = Isisurat::find()->where(['id_informasi' => $model->id_informasi])->one();
        if (strpos($carisurat->isi, '{ttd}')) {
            $isi = str_replace('{ttd}', $data, $carisurat->isi);
            $carisurat->isi = $isi;
            $carisurat->save();
        }

        $data = Informasisurat::find()->where(['id' => $model->id_informasi])->one();
        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Tanda Tangan Surat Baru";
        $log->date = Date("Y-m-d H:i:s");
        $log->no_surat = $data->no_surat;
        $log->save();

        return $this->redirect(['update', 'id' => $id]);
        return $this->render('langsung', [
            'model' => $model,




        ]);
    }


    public function actionPrint($id)
    {
        $model = $this->findModel($id);
        $surat =  Isisurat::find()->where(['id_informasi' => $model->id_informasi])->one();
        return $this->renderAjax('_pdf', [
            'surat' => $surat,
            'model' => $model


        ]);
    }
}
