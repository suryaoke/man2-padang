<?php

namespace backend\controllers;

use backend\models\Informasisurat;
use backend\models\PasswordForm;
use backend\models\PasswordResetRequestForm;
use backend\models\Pembuatsurat;
use backend\models\ResendVerificationEmailForm;
use backend\models\ResetPasswordForm;
use backend\models\SignupForm;

use backend\models\Smpenerima;
use backend\models\Smterkirim;
use backend\models\Suratmasuk;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;

use backend\models\Tandatangan;
use backend\models\Tujuansurat;
use backend\models\User;
use common\models\User as user1;
use backend\models\Verifikasi;
use backend\models\VerifyEmailForm;
use common\models\LoginForm;
use Exception;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],

                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index',],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    //logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
    public function beforeAction($action)
    {


        if ($action->id == 'upload-ckeditor') {
            $this->enableCsrfValidation = false;
        }

        //return true;
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {

        $model = Smpenerima::find()->where(['id_penerima' => Yii::$app->user->identity->id]);
        $count = $model->count();
        $model1 = Smterkirim::find();
        $model2 = Pembuatsurat::find()->where(['id_user' => Yii::$app->user->identity->id]);
        $model3 = Informasisurat::find();
        $model4 = Verifikasi::find();
        $model5  = Tandatangan::find();

        $count1 = $model1->count();
        $count2 = $model2->count();
        $count3 = $model3->count();
        $count4 = $model4->count();
        $count5 = $model5->count();
        $modeltujuan = Tujuansurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $modeltanda = Tandatangan::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
        $modelpembuat = Pembuatsurat::find()->where(['id_user' => Yii::$app->user->identity->id])->one();
       
        $DB = Yii::$app->db;
        $data = Suratmasuk::find()->one();
        $a = Suratmasuk::find()->orderBy('id_sm ')->one();
        $b = Suratmasuk::find()->groupBy("kirim_at");

        $thn = date('Y');
        $jumlah0 = $DB->createCommand("SELECT *,COUNT(kirim_at) AS jumlah FROM `informasisurat`   GROUP BY kirim_at")->queryAll();
        $jumlah01 = $DB->createCommand("SELECT * FROM `suratmasuk`   GROUP BY kirim_at")->queryOne();
       
        $jumlah1 = $DB->createCommand("SELECT *,COUNT(kirim_at) AS jumlah FROM `suratmasuk`where asal_surat='Luar Sekolah'  GROUP BY kirim_at")->queryAll();
      
        
        $informasisurat = Informasisurat::find()->orderBy('id DESC')->all();
        $semester1 = $DB->createCommand("SELECT *,COUNT(kirim_at) AS jumlah FROM `informasisurat`
        WHERE MONTH(kirim_at ) IN ('01','02','03','04','05','06') 
        GROUP BY MONTH(kirim_at) ORDER BY MONTH(kirim_at ) IN ('01','02','03','04','05','06')")->queryAll();
        
        return $this->render('index', [
            'count' => $count,
            'count1' => $count1,
            'count2' => $count2,
            'count3' => $count3,
            'count4' => $count4,
            'count5' => $count5,
            'modeltujuan' => $modeltujuan,
            'modelpembuat' => $modelpembuat,
            'modeltanda' => $modeltanda,
            'data' => $data,
            'a' => $a,
            'b' => $b,
            'jumlah0' => $jumlah0,
            'jumlah1' => $jumlah1,
            'jumlah01' => $jumlah01,
            'semester1' => $semester1,
            'informasisurat' => $informasisurat,
          
        ]);
     
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionSignup()
    {
        $model = new SignupForm();

        if ($model->load(Yii::$app->request->post()) && $model->signup()) {

            return $this->redirect(['site/user']);
        }

        return $this->render('signup', [
            'model' => $model,

        ]);
    }

    public function actionUser()
    {
        $model = new SignupForm();

        $user = User::find()->all();
        return $this->render('user', [
            'model' => $model,
            'user' => $user,

        ]);
    }

    public function actionDelete2($del)
    {
        $query = User::findOne($del);
        $query->delete();

        return $this->redirect(['site/user', 'id' => $query->id]);
    }

    public function actionUploadCkeditor()
    {
        if (isset($_FILES['upload']['name'])) {
            $file = $_FILES['upload']['tmp_name'];
            $file_name = $_FILES['upload']['name'];
            $file_name_array = explode(".", $file_name);
            $extension = end($file_name_array);
            $new_image_name = rand() . '.' . $extension;
            // chmod('upload', 0777);
            $allowed_extension = array("jpg", "gif", "png");
            if (in_array($extension, $allowed_extension)) {
                move_uploaded_file($file, 'upload/ckeditor_image/' . $new_image_name);
                $function_number = $_GET['CKEditorFuncNum'];
                $url = Url::toRoute(['/upload/ckeditor_image/' . $new_image_name]);
                $message = '';
                echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
            }
        } else {
            echo 'kosong';
        }
    }
    public function actionNotifikasi()
    {

        return $this->render('notifikasi');
    }


    public function actionChangepassword()
    {
        $model = new PasswordForm();
        $modeluser = User1::find()->where([
            'username' => Yii::$app->user->identity->username
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
                    return $this->render('changepassword', [
                        'model' => $model
                    ]);
                }
            } else {
                return $this->render('changepassword', [
                    'model' => $model
                ]);
            }
        } else {
            return $this->render('changepassword', [
                'model' => $model
            ]);
        }
    }

    
    public function actionRequestPasswordReset()
    {
        $this->layout = 'blank';
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    public function actionResetPassword($token)
    { 
        $this->layout = 'blank';
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
   
}
