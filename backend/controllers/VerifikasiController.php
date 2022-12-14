<?php

namespace backend\controllers;


use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Log;
use backend\models\Notif1;
use backend\models\Notif2;
use backend\models\Pembuatsurat;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\Tanda;
use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use backend\models\Verifikasi;
use backend\models\VerifikasiSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VerifikasiController implements the CRUD actions for Verifikasi model.
 */
class VerifikasiController extends Controller
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

    /**
     * Lists all Verifikasi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VerifikasiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataverifikasi = Verifikasi::find()->select(['id_informasi'])->distinct()->orderBy('id DESC')->all();
        $info = Verifikasi::find()->orderBy('id DESC')->one();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataverifikasi' =>  $dataverifikasi,
            'info' => $info,



        ]);
    }

    /**
     * Displays a single Verifikasi model.
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
     * Creates a new Verifikasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Verifikasi();

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
     * Updates an existing Verifikasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Verifikasi model.
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
     * Finds the Verifikasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Verifikasi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Verifikasi::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionHasil($id)
    {
        $model1 = $this->findModel($id);
        $model = new Verifikasi();

        $dataverifikasi  = Verifikasi::find()->where(['id_informasi' => $model1->id_informasi])->all();
        $datainformasi = Informasisurat::find()->where(['id' => $model1->id_informasi])->all();
        $dataisi = Isisurat::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $datainfo = Informasisurat::find()->where(['id' => $model1->id_informasi])->one();
        $datatandatangan  = Tandatangan::find()->where(['id_informasi' => $model1->id_informasi])->all();
        $tanda  = Tandatangan::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model1->id_informasi])->one();
        if ($model->load(Yii::$app->request->post())) {

            $model->save();
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Kirim Perbaikan Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $datainfo->no_surat;
            $log->save();
 
            return $this->redirect(['informasisurat/index']);
        }

        return $this->render('hasil', [

            'model' => $model,
            'model1' => $model1,
            'dataverifikasi' => $dataverifikasi,
            'datainformasi' => $datainformasi,
            'dataisi' => $dataisi,
            'datainfo' => $datainfo,
            'datatandatangan' => $datatandatangan,
            'tanda' => $tanda,
            'pembuat' => $pembuat,


        ]);
    }

    public function actionPeriksa($id)
    {

        $model1 = $this->findModel($id);
        $model = new Verifikasi();
        $model2 = new Tandatangan();
        $model3 = new Notif2();
        $datainformasi = Informasisurat::find()->where(['id' => $model1->id_informasi])->all();
        $dataisi = Isisurat::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $datainfo = Informasisurat::find()->where(['id' => $model1->id_informasi])->one();

      	   if( Yii::$app->user->identity->role != "admin"){
        $notif = Notif2::find()->where(['id_sk' => $model1->id_informasi , 'tujuan' => Yii::$app->user->identity->id])->one();
        $notif->status = "dibaca";
             $notif->save();}

        if ($model1->load($this->request->post()) && $model2->load($this->request->post()) && $model3->load($this->request->post())) {

            $model1->save();
            $model2->save();

            $model3->save();
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Konfirmasi Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $datainfo->no_surat;
            $log->save();

            return $this->redirect('index');
        }
        if ($model->load($this->request->post())) {



            $model->save();
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Perbaiki Surat Baru";
            $log->date = Date("Y-m-d H:i:s");
            $log->no_surat = $datainfo->no_surat;
            $log->save();


            return $this->redirect(['index']);
        }
        return $this->render('periksa', [

            'model' => $model,
            'model1' => $model1,
            'datainformasi' => $datainformasi,
            'dataisi' => $dataisi,
            'datainfo' => $datainfo,
            'model2' => $model2,
            'model3' => $model3,



        ]);
    }


    public function actionSuratmasukdalam($id)
    {
        $model0 = $this->findModel($id);
        $tujuan = Tujuansurat::find()->where(['id_informasi_surat' => $model0->id_informasi])->all();


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
            $model3->id_sm = $model1->id_sm;
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


    public function actionSuratmasukkeluar($id)
    {
        $model0 = $this->findModel($id);
        $info = Informasisurat::find()->where(['id' => $model0->id_informasi])->one();


        $info->status = "dikirim";
        $info->save();


        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Kirim Surat Baru";
        $log->date = Date("Y-m-d H:i:s");
        $log->no_surat = $info->no_surat;
        $log->save();


     
       


        return $this->redirect(['informasisurat/index']);
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
