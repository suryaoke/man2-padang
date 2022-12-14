<?php

namespace backend\controllers;

use backend\models\Log;
use backend\models\LogSearch;
use backend\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LogController implements the CRUD actions for Log model.
 */
class LogController extends Controller
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
     * Lists all Log models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $log = Log::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'log' => $log
        ]);
    }



    public function actionGuru()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $user = User::find()->where(['role' => "Guru"])->one();
        $log = Log::find()->where(['id_user' => $user->id])->orderBy('id DESC')->all();

        return $this->render('guru', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'log' => $log
        ]);
    }

    
    public function actionKepsek()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $user = User::find()->where(['role' => "kepsek"])->one();
        $log = Log::find()->where(['id_user' => $user->id])->orderBy('id DESC')->all();

        return $this->render('kepsek', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'log' => $log
        ]);
    }

    public function actionVerificator()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $user = User::find()->where(['role' => "verificator"])->one();
        $log = Log::find()->where(['id_user' => $user->id])->orderBy('id DESC')->all();

        return $this->render('verificator', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'log' => $log
        ]);
    }

    public function actionWakil()
    {
        $searchModel = new LogSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $user = User::find()->where(['role' => "wakil"])->one();
        $log = Log::find()->where(['id_user' => $user->id])->orderBy('id DESC')->all();

        return $this->render('wakil', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'log' => $log
        ]);
    }
    /**
     * Displays a single Log model.
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
     * Creates a new Log model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
  

    /**
     * Updates an existing Log model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  
    /**
     * Deletes an existing Log model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
  

    /**
     * Finds the Log model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Log the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Log::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
