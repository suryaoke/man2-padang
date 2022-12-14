<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Lampiransurat;
use backend\models\Log;
use backend\models\Notif2;
use backend\models\Pembuatsurat;
use backend\models\SearchIsisurat;
use backend\models\Tandatangan;
use backend\models\Tembusansurat;
use backend\models\Tujuansurat;
use backend\models\Verifikasi;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * IsisuratController implements the CRUD actions for Isisurat model.
 */
class IsisuratController extends Controller
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
     * Lists all Isisurat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchIsisurat();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Isisurat model.
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
     * Creates a new Isisurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Isisurat();

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
     * Updates an existing Isisurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $informasi = Informasisurat::find()->where(['id' => $model->id_informasi])->one();
        $tujuann = Tujuansurat::find()->where(['id_informasi_surat' => $model->id_informasi])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model->id_informasi])->one();
        $pembuat = Pembuatsurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $data = Isisurat::find()->where(['id_informasi' => $model])->all();

        $tujuan = Tujuansurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $isi = Isisurat::find()->where(['id_informasi' => $data])->one();

        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model->id_informasi])->orderBy('id DESC')->one();
         if (Yii::$app->user->identity->id == $tujuann->id_user) {
            $model1 = Notif2::find()->where(['id_sk' => $isi['id_informasi'], 'tujuan' => Yii::$app->user->identity->id])->one();
            $model2 = Tujuansurat::find()->where(['id_informasi_surat' => $isi['id_informasi'], 'id_user' => Yii::$app->user->identity->id])->one();
            $model1->status =  "dibaca";
            $model1->save();
            $model2->status =  "dibaca";
            $model2->save();
        }

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {



            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
            'tujuan' => $tujuan,
            'isi' => $isi,
            'informasi' => $informasi,
            'tujuann' => $tujuann,
            'tanda' => $tanda,
            'pembuat' => $pembuat,
            'dataverifikasi' => $dataverifikasi,

        ]);
    }

    /**
     * Deletes an existing Isisurat model.
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

    public function actionDelete2($del)
    {
        $query = Lampiransurat::findOne($del);

        $query->delete();
        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Hapus Lampiran Surat Baru";
        $log->date = Date("d-m-Y ");
        $log->save();
        $data = Isisurat::find()->where(['id_informasi' => $query->id_informasi])->one();
        return $this->redirect(['lampiran', 'id' => $data->id]);
    }


    public function actionDelete3($del)
    {
        $query = Tembusansurat::findOne($del);

        $query->delete();
        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Hapus Tembusan Surat Baru";
        $log->date = Date("d-m-Y ");
        $log->save();
        $data = Isisurat::find()->where(['id_informasi' => $query->id_informasi])->one();
        return $this->redirect(['tembusan', 'id' => $data->id]);
    }
    /**
     * Finds the Isisurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Isisurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Isisurat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLampiran($id)
    {

        $model1 = $this->findModel($id);
        $informasi = Informasisurat::find()->where(['id' => $model1->id_informasi])->one();
        $tujuan  = Tujuansurat::find()->where(['id_informasi_surat' => $model1->id_informasi])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $model = new Lampiransurat();

        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model1->id_informasi])->orderBy('id DESC')->one();
        $datalampiran = Lampiransurat::find()->where(['id_informasi' => $model1->id_informasi])->all();
        // $data = Lampiransurat::find()->where(['id_informasi' => $model1]);
        // $jumlah = $data->count();
        // $hasil = $jumlah +  1;

        if ($model->load(Yii::$app->request->post())) {
            $imageFile = UploadedFile::getInstance($model, 'file');
            if (isset($imageFile->size)) {
                $imageFile->saveAs('upload/lampiran/' . $imageFile->baseName . '.' . $imageFile->extension);
            }
            $model->file = $imageFile->baseName . '.' . $imageFile->extension;
            $model->save(false);


            // $carisurat = Isisurat::find()->where(['id' => $model1->id])->one();
            // if (strpos($carisurat->isi, '{lampiran}')) {
            //     $isi = str_replace('{lampiran}', $hasil, $carisurat->isi);
            //     $carisurat->isi = $isi;
            //     $carisurat->save();
            // }
            // else if (strpos($carisurat->isi, $hasil)) {
            //     $isi = str_replace($jumlah, $hasil, $carisurat->isi);
            //     $carisurat->isi = $isi;
            //     $carisurat->save();
            // }

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Buat Lampiran Surat Baru";
            $log->date = Date("d-m-Y ");
            $log->save();


            return $this->redirect(['isisurat/lampiran', 'id' => $model1->id]);
        }

        return $this->render('lampiran', [
            'model1' => $model1,
            'model' => $model,
            'datalampiran' => $datalampiran,
            //'data' => $data,
            //  'jumlah' => $jumlah,
            'tujuan' => $tujuan,
            'informasi' => $informasi,
            'tanda' => $tanda,
            'dataverifikasi' => $dataverifikasi,
        ]);
    }

    public function actionTembusan($id)
    {

        $model1 = $this->findModel($id);
        $model = new Tembusansurat();
        $data = Tembusansurat::find()->where(['id_informasi' => $model1])->one();
        $datainformasi = Informasisurat::find()->where(['id' => $model1->id_informasi])->one();
        $tujuan =  Tujuansurat::find()->where(['id_informasi_surat' => $model1->id_informasi])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model1->id_informasi])->one();
        $datatembusan = Tembusansurat::find()->where(['id_informasi' => $model1->id_informasi])->all();

        $dataverifikasi = Verifikasi::find()->where(['id_informasi' => $model1->id_informasi])->orderBy('id DESC')->one();
        if ($model->load(Yii::$app->request->post())) {
            $model->save();


            // $carisurat = Isisurat::find()->where(['id' => $model1->id])->one();
            // if (strpos($carisurat->isi, '{tembusan}')) {
            //     $isi = str_replace('{tembusan}', $data->id_user, $carisurat->isi);
            //     $carisurat->isi = $isi;
            //     $carisurat->save();
            // }
            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Buat Tembusan Surat Baru";
            $log->date = Date("d-m-Y ");
            $log->save();


            return $this->redirect(['isisurat/tembusan', 'id' => $model1->id]);
        }

        return $this->render('tembusan', [

            'model' => $model,
            'model1' => $model1,
            'data' => $data,
            'datainformasi' => $datainformasi,
            'tujuan' => $tujuan,
            'tanda' => $tanda,
            'datatembusan' => $datatembusan,
            'dataverifikasi' => $dataverifikasi,
        ]);
    }



    public function actionPrint($id)
    {
        $model1 = $this->findModel($id);
        $surat =  Isisurat::find()->where(['id_informasi' => $model1 ->id_informasi])->one();
     return $this->renderAjax('_pdf',[
        'surat' => $surat,
        'model1' => $model1,
        
    ]);
    }
    
}
