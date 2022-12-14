<?php

namespace backend\controllers;

use backend\models\User;
use backend\models\UserSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use Exception;
use common\models\User as user1;
use backend\models\PasswordForm;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $user = User::find()->where(['id' => Yii::$app->user->identity->id])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user' => $user,
        ]);
    }

    // public function actionChange_password()
    // {

    //     $user =  Yii::$app->user->identity;
    //     $loadePost = $user->load(Yii::$app->request->post());
    //     if ($loadePost && $user->validate()) {
    //         $user->password = $user->newPassword;
    //         $user->save(false);
    //         Yii::$app->session->setFlash('success', 'berhasil');
    //         return $this->refresh();
    //     }
    //     return $this->render('change_password', [
    //         'user' => $user,
    //     ]);
    // }




    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new User();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $imageFile = UploadedFile::getInstance($model, 'foto');
                if (isset($imageFile->size)) {
                    $imageFile->saveAs('upload/user/' . $imageFile->baseName . '.' . $imageFile->extension);
                }
                $model->foto = $imageFile->baseName . '.' . $imageFile->extension;

                $model->save(false);
                return $this->redirect(['site/user', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $imageFile = UploadedFile::getInstance($model, 'foto');
            if (isset($imageFile->size)) {
                $imageFile->saveAs('upload/user/' . $imageFile->baseName . '.' . $imageFile->extension);
            }
            $model->foto = $imageFile->baseName . '.' . $imageFile->extension;

            $imageFile1 = UploadedFile::getInstance($model, 'file');
            if (isset($imageFile->size)) {
                $imageFile1->saveAs('upload/tandatangan/' . $imageFile1->baseName . '.' . $imageFile1->extension);
            }
            $model->file = $imageFile1->baseName . '.' . $imageFile1->extension;



            $model->save(false);

            if (Yii::$app->user->identity->role == "admin") {

                return $this->redirect(['site/user', 'id' => $model->id]);
            } else {
                return $this->redirect(['index']);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionStatus($id)
    {

        $model = $this->findModel($id);
        $model1 = new User();

        if ($this->request->isPost && $model->load($this->request->post()) && $model1->load($this->request->post())) {

            $model->save(false);
        
            return $this->redirect(['site/user']);
        }

        return $this->render('status', [
            'model' => $model,
            'model1' => $model1,
        ]);
    }

    
   
    public function actionResetpassword($id)
    {
        $model = new PasswordForm();
        $modeluser = User1::find()->where([
            'id' => $id
        ])->one();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->validate()) {
                try {
                    $modeluser->password_hash = Yii::$app->security->generatePasswordHash($_POST['PasswordForm']['newpass']);
                    
                    if ($modeluser->save()) {
                        Yii::$app->getSession()->setFlash(
                            'success',
                            'Password changed'
                        );
                        return $this->redirect(['index']);
                    } else {
                        Yii::$app->getSession()->setFlash(
                            'error',
                            'Password not changed'
                        );
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    Yii::$app->getSession()->setFlash(
                        'error',
                        "{$e->getMessage()}"
                    );
                    return $this->render('resetpassword', [
                        'model' => $model
                    ]);
                }
            } else {
                return $this->render('resetpassword', [
                    'model' => $model
                ]);
            }
        } else {
            return $this->render('resetpassword', [
                'model' => $model
            ]);
        }
    }



}
