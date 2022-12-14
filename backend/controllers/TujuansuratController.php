<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Pembuatsurat;
use backend\models\Tujuansurat;
use backend\models\SearchTujuansurat;
use backend\models\Tandatangan;
use backend\models\Verifikasi;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
/**
 * TujuansuratController implements the CRUD actions for Tujuansurat model.
 */
class TujuansuratController extends Controller
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
     * Lists all Tujuansurat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchTujuansurat();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Tujuansurat model.
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
     * Creates a new Tujuansurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Tujuansurat();

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
     * Updates an existing Tujuansurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $informasi = Informasisurat::find()->where(['id' => $model->id_informasi_surat])->one();
        $isi = Isisurat::find()->where(['id_informasi' => $model->id_informasi_surat])->one();
        $tanda = Tandatangan::find()->where(['id_informasi' => $model->id_informasi_surat])->one();
        $pembuat = Pembuatsurat::find()->where(['id_informasi' => $model->id_informasi_surat])->one();

     
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'informasi' =>  $informasi,
            'isi' => $isi,
            'tanda' => $tanda,
            'pembuat' => $pembuat,
        ]);
    }

    /**
     * Deletes an existing Tujuansurat model.
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
     * Finds the Tujuansurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Tujuansurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Tujuansurat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionIsisurat($id)
    {


        $model = new Isisurat();
        $data = Informasisurat::find()->all();
        $data1 = Tujuansurat::find()->all();
        if ($model->load(Yii::$app->request->post())) {


            $model->save();

            return $this->redirect(['isisurat/update', 'id' => $model->id]);
        }

        return $this->render('isisurat', [

            'model' => $model,
            'data' => $data,
            'data1' => $data1,


        ]);
    }

  

}
