<?php

namespace backend\controllers;

use backend\models\Smdisposisi;
use backend\models\SmdisposisiSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SmdisposisiController implements the CRUD actions for Smdisposisi model.
 */
class SmdisposisiController extends Controller
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
                    'only' => ['update','delete','index','create'],
                    'rules' => [
                        [
                            
                            'allow' => true,
                            'roles' => ['@'],
                            // 'matchCallback' => function ($rule, $action) { 
                            //     if (Yii::$app->user->identity->role == '') {
                            //     return true;
                            //     }}
                        ],
                       
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Smdisposisi models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SmdisposisiSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $smdisposisi = Smdisposisi::find()->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'smdisposisi' => $smdisposisi,
        ]);
    }

    /**
     * Displays a single Smdisposisi model.
     * @param int $id_sm_disposisi Id Sm Disposisi
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_sm_disposisi)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_sm_disposisi),
        ]);
    }

    /**
     * Creates a new Smdisposisi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Smdisposisi();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_sm_disposisi' => $model->id_sm_disposisi]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Smdisposisi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_sm_disposisi Id Sm Disposisi
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_sm_disposisi)
    {
        $model = $this->findModel($id_sm_disposisi);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_sm_disposisi' => $model->id_sm_disposisi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Smdisposisi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_sm_disposisi Id Sm Disposisi
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_sm_disposisi)
    {
        $this->findModel($id_sm_disposisi)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Smdisposisi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_sm_disposisi Id Sm Disposisi
     * @return Smdisposisi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_sm_disposisi)
    {
        if (($model = Smdisposisi::findOne(['id_sm_disposisi' => $id_sm_disposisi])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
}
