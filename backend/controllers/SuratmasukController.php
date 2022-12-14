<?php

namespace backend\controllers;


use backend\models\Log;
use backend\models\Notif1;
use backend\models\Smdisposisi;
use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use backend\models\SuratmasukSearch;
use kartik\mpdf\Pdf;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/*
 * SuratmasukController implements the CRUD actions for Suratmasuk model.
 */

class SuratmasukController extends Controller
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
                'access' => [
                    'class' => AccessControl::className(),
                    'only' => ['update', 'delete', 'index', 'create'],
                    'rules' => [
                        [

                            'allow' => true,
                            'roles' => ['@'],
                        ],

                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Suratmasuk models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SuratmasukSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $surat = Smpenerima::find()->where(['id_penerima' => Yii::$app->user->identity->id])->orderBy('id DESC')->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'surat' => $surat,

        ]);
    }

    /**
     * Displays a single Suratmasuk model.
     * @param int $id_sm Id Sm
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    /**
     * Creates a new Suratmasuk model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Suratmasuk();
        $model2 = new Smterkirim();
        $model3 = new Notif1();
        $model4 = new Smpenerima();
        $log = new Log();
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                //    Surat Masuk //
                $model->kirim_at = date('Y-m-d H:i:s');
                $model->status = ("belum dibaca");
                $model->file2 = 0;
                $imageFile = UploadedFile::getInstance($model, 'file');
                if (isset($imageFile->size)) {
                    $imageFile->saveAs('upload/suratmasuk/' . $imageFile->baseName . '.' . $imageFile->extension);
                }
                $model->file = $imageFile->baseName . '.' . $imageFile->extension;
                $model->save();
               
               // Sm Terikirim //
                $model2->id_pengirim = Yii::$app->user->identity->id ;
                $model2->id_sm = $model->id_sm;
                $model2->save();

                // Notif 1//
                $model3->id_sm = $model->id_sm;
                $model3->created_at = date('Y-m-d H:i:s');
                $model3->tujuan = $model->tujuan;
                $model3->isi = $model->perihal;
                $model3->header = "Surat Masuk";
                $model3->status = "belum dibaca";
                $model3->id_pengirim =  Yii::$app->user->identity->id;
                $model3->save();

                // smpenerima//
                $model4->id_sm = $model->id_sm;
                $model4->id_penerima = $model->tujuan;
                $model4->id_pengirim = Yii::$app->user->identity->id;
                $model4->status = "belum dibaca";
                $model4->save();


                // log //
                $log->id_user =  Yii::$app->user->identity->id;
                $log->perihal = "Buat Surat Masuk";
                $log->date = Date("Y-m-d H:i:s");
                $log->no_surat = $model->no_surat;
                $log->save();


                return $this->redirect(['smterkirim']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model2' => $model2,
            'model3' => $model3,
            'model4' => $model4,
            'log'  => $log
        ]);
    }

    /**
     * Updates an existing Suratmasuk model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_sm Id Sm
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
   
    /**
     * Deletes an existing Suratmasuk model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_sm Id Sm
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionDeletesmdisposisi($id_sm)
    {
        $model = $this->findModel($id_sm);

        if (Smdisposisi::find()->where(['id_sm' => $id_sm, 'id_pengirim' => Yii::$app->user->identity->id])->one()->delete()) {


            if (Smpenerima::find()->where(['id_sm' => $id_sm, 'id_pengirim' => Yii::$app->user->identity->id])->one()->delete()) {
            }
            if (Notif1::find()->where(['id_sm' => $id_sm, 'id_pengirim'  => Yii::$app->user->identity->id])->one()->delete()) {


                $log = new Log();
                $log->id_user =  Yii::$app->user->identity->id;
                $log->perihal = "Hapus Surat Masuk Disposisi";
                $log->date = Date("d-m-Y ");
                $log->no_surat = $model->no_surat;
                $log->save();

                return $this->redirect(['smdisposisi', 'id_sm' => $id_sm]);
            }
        }
    }

    public function actionDelete($id_sm)
    {
        $model = $this->findModel($id_sm);

        $smmasuk = Suratmasuk::find()->where(['id_sm' => $id_sm])->one();
        $smterkirim = Smterkirim::find()->where(['id_sm' => $id_sm])->one();
        $smpenerima = Smpenerima::find()->where(['id_sm' => $id_sm])->one();
        $notif = Notif1::find()->where(['id_sm' => $id_sm])->one();
        $smdisposisi = Smdisposisi::find()->where(['id_sm' => $id_sm])->one();
        if ($smmasuk  != null) {
            $smmasuk->delete();
        }
        if ($smterkirim  != null) {
            $smterkirim->delete();
        }
        if ($smpenerima  != null) {
            $smpenerima->delete();
        }
        if ($notif  != null) {
            $notif->delete();
        }
        if ($smdisposisi  != null) {
            $smdisposisi->delete();
        }
        $log = new Log();
        $log->id_user =  Yii::$app->user->identity->id;
        $log->perihal = "Hapus Surat Masuk";
        $log->date = Date("d-m-Y ");
        $log->no_surat = $model->no_surat;
        $log->save();
        return $this->redirect(['suratmasuk/smterkirim']);
    }

    public function actionDelete2($del)
    {
        $query = Smdisposisi::findOne($del);


        $query->delete();
        return $this->redirect(['smdisposisi', 'id_sm' => $query->id_sm]);
    }

    public function actionSmdisposisi($id_sm)
    {

        $model = $this->findModel($id_sm);

        $model1 = new Smdisposisi();
        $model3 = new Smpenerima();
        $model2 = new Notif1();
        $disposisi = Suratmasuk::find()->where(['tujuan' => Yii::$app->user->identity->id])->all();
       
        $surat =  Suratmasuk::find()->where(['id_sm' => $id_sm])->one();
        $db = Yii::$app->db;


        $data = Suratmasuk::find()->where(['id_sm' => $id_sm])->all();
        $data1 = Suratmasuk::find()->where(['id_sm' => $id_sm])->one();
        $querysmdisposisi = Smdisposisi::find()->where(['id_sm' => $id_sm])->all();

        $querysm = $db->createCommand("SELECT *FROM suratmasuk
        WHERE suratmasuk.id_sm= " . $id_sm . "
        ORDER BY suratmasuk.id_sm")->queryAll();



        $model4 = Smpenerima::find()->where(['id_sm' => $id_sm,'id_penerima' => Yii::$app->user->identity->id])->one();
        $model4->status = "dibaca";
        $model5 = Notif1::find()->where(['id_sm' => $id_sm ,'tujuan' => Yii::$app->user->identity->id])->one();
        $model5->status =  "dibaca";
        $model4->save();
        $model5->save();

        if ($data1->asal_surat == "Luar Sekolah") {

            if (Yii::$app->user->identity->role != "kepsek") {
                $model6 =  Smdisposisi::find()->where(['id_sm' => $id_sm, 'id_penerima' => Yii::$app->user->identity->id])->one();
                $model6->status = "dibaca";
                $model6->save();
            }
        }



        if ($model1->load(Yii::$app->request->post())) {
            
            
            $model1->kirim_at = date('Y-m-d H:i:s');
            $model1->status = "belum dibaca";
            $model1->save();
           
           // Notif //
            $model2->id_sm = $model1->id_sm;
            $model2->created_at = date('Y-m-d H:i:s');
            $model2->tujuan = $model1->id_penerima;
            $model2->id_pengirim =  Yii::$app->user->identity->id;
            $model2->header = "Surat Masuk";
            $model2->isi = $model1->isi;
            $model2->status = "belum dibaca";
            $model2->save();
            


            // smpenerima//
            $model3->id_sm = $model1->id_sm;
            $model3->id_penerima = $model1->id_penerima;
            $model3->id_pengirim = Yii::$app->user->identity->id;
            $model3->status = "belum dibaca";
            $model3->save();

            // log/

            $log = new Log();
            $log->id_user =  Yii::$app->user->identity->id;
            $log->perihal = "Buat Surat Masuk Disposisi";
            $log->date = Date("d-m-Y ");
            $log->no_surat = $model->no_surat;
            $log->save();


            return $this->redirect(['suratmasuk/smdisposisi', 'id_sm' => $model1->id_sm]);
        }

        return $this->render('smdisposisi', [
            'model' => $model,
            'model1' => $model1,
            'model2' => $model2,
            'model3' => $model3,
            'querysmdisposisi' =>   $querysmdisposisi,
            'data' => $data,
            'id_sm' => $id_sm,
            'querysm' =>  $querysm,
            'disposisi' => $disposisi,
            'surat' => $surat,



        ]);
    }


    public function actionSmterkirim()
    {
        
        $smterkirim = Smterkirim::find()->orderBy('id DESC')->all();
      
        return $this->render('smterkirim', [

            'smterkirim' => $smterkirim,
      
        ]);
    }

    public function actionTerkirimdisposisi($id_sm)
    {
        $model = $this->findModel($id_sm);
        
        $smterkirim = Smterkirim::find()->where(['id_sm' => $model])->all();
        $querysmdisposisi = Smdisposisi::find()->where(['id_sm' => $model])->all();
        $surat =  Suratmasuk::find()->where(['id_sm' => $id_sm])->one();
        return $this->render('terkirimdisposisi', [
            'smterkirim' => $smterkirim,
            'querysmdisposisi' =>  $querysmdisposisi,
            'surat' => $surat
        ]);
    }


    /**
     * Finds the Suratmasuk model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_sm Id Sm
     * @return Suratmasuk the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_sm)
    {
        if (($model = Suratmasuk::findOne(['id_sm' => $id_sm])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionPrint($id_sm)
    {

        $surat =  Suratmasuk::find()->where(['id_sm' => $id_sm])->one();
     return $this->renderAjax('pdf',[
        'surat' => $surat,
        
        
    ]);
    }
}
