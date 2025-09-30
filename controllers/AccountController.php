<?php
namespace app\controllers;

use Yii;
use app\models\Account;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class AccountController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index','view','create','update','delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($rule, $action) {
                            return Yii::$app->user->identity->role === 'Admin';
                        }
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Account::find(),
            'pagination' => ['pageSize'=>20],
        ]);
        return $this->render('index', ['dataProvider'=>$dataProvider]);
    }

    public function actionCreate()
    {
        $model = new Account();

        if ($model->load(Yii::$app->request->post())) {

            $model->password = password_hash($model->password, PASSWORD_DEFAULT);
            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Akun berhasil dibuat!');
                return $this->redirect(['index']);
            }
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionView($username)
    {
        return $this->render('view', [
            'model' => $this->findModel($username),
        ]);
    }

    public function actionUpdate($username)
    {
        $model = $this->findModel($username);

        if ($model->load(Yii::$app->request->post())) {
            $post = Yii::$app->request->post('Account');
            if (!empty($post['password'])) {
                $model->password = password_hash($post['password'], PASSWORD_DEFAULT);
            } else {
                $model->password = $model->getOldAttribute('password');
            }

            if ($model->save(false)) {
                Yii::$app->session->setFlash('success', 'Akun berhasil diupdate!');
                return $this->redirect(['index']);
            }
        }

        $model->password = '';

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDelete($username)
    {
        $this->findModel($username)->delete();
        Yii::$app->session->setFlash('success', 'Akun berhasil dihapus!');
        return $this->redirect(['index']);
    }

    protected function findModel($username)
    {
        if (($model = Account::findOne(['username' => $username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
