<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\Isisurat;
use backend\models\Lampiransurat;
use backend\models\SearchLampiransurat;
use backend\models\Tembusansurat;
use backend\models\Tujuansurat;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LampiransuratController implements the CRUD actions for Lampiransurat model.
 */
class LampiransuratController extends Controller
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
     * Lists all Lampiransurat models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchLampiransurat();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lampiransurat model.
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
     * Creates a new Lampiransurat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Lampiransurat();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
                $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
                if ($model->validate()) {
                    $saveTo = 'upload/lampiran/' . $model->file->baseName . '.' . $model->file->extension;
                    if ($model->file->saveAs($saveTo)) {
                        $model->file = $model->file ->baseName . '.' . $model->file->extension;
               }}
                    
                $model->save(false);
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
     * Updates an existing Lampiransurat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data1 = Isisurat::find()->where(['id_informasi' => $model])->all();
        $data2 = Lampiransurat::find()->where(['id_informasi'=> $model])->all();

        if ($this->request->isPost && $model->load($this->request->post()) ) {
            
            $model->file = \yii\web\UploadedFile::getInstance($model, 'file');
            if ($model->validate()) {
                $saveTo = 'upload/lampiran/' . $model->file->baseName . '.' . $model->file->extension;
                if ($model->file->saveAs($saveTo)) {
                    $model->file = $model->file ->baseName . '.' . $model->file->extension;
           }}
                
            $model->save(false);
            return $this->redirect(['update', 'id' => $model->id]);
            
        }

        return $this->render('update', [
            'model' => $model,
            'data1' => $data1,
            'data2' => $data2,
        
        ]);
    }

    /**
     * Deletes an existing Lampiransurat model.
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
     * Finds the Lampiransurat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Lampiransurat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lampiransurat::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
