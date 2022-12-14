<?php

namespace backend\controllers;

use backend\models\Reportsm;
use backend\models\SearchReportsm;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReportsmController implements the CRUD actions for Reportsm model.
 */
class ReportsmController extends Controller
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
     * Lists all Reportsm models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SearchReportsm();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $dataProvider->pagination = false;
        $dataProvider->sort = [
            'defaultOrder' => [
                'id_sm' => SORT_DESC,
               
            ]
            ];
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reportsm model.
     * @param int $id_sm Id Sm
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_sm)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_sm),
        ]);
    }

    /**
     * Creates a new Reportsm model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Reportsm();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_sm' => $model->id_sm]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Reportsm model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_sm Id Sm
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_sm)
    {
        $model = $this->findModel($id_sm);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_sm' => $model->id_sm]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Reportsm model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_sm Id Sm
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_sm)
    {
        $this->findModel($id_sm)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reportsm model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_sm Id Sm
     * @return Reportsm the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_sm)
    {
        if (($model = Reportsm::findOne(['id_sm' => $id_sm])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
