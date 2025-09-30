<?php
namespace app\controllers;

use Yii;
use app\models\Post;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\web\ForbiddenHttpException;

class PostController extends Controller
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
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Post::find()->orderBy(['date'=>SORT_DESC]),
            'pagination' => ['pageSize'=>10],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    public function actionCreate()
    {
        $model = new Post();
        if ($model->load(Yii::$app->request->post())) {
            $model->username = Yii::$app->user->id; 
            $model->date = date('Y-m-d H:i:s');
            if ($model->save()) {
                return $this->redirect(['view','id'=>$model->idpost]);
            }
        }
        return $this->render('create', ['model'=>$model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if (Yii::$app->user->identity->role !== 'Admin' && $model->username !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Anda tidak berwenang mengedit post ini.');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view','id'=>$model->idpost]);
        }

        return $this->render('update', ['model'=>$model]);
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (Yii::$app->user->identity->role !== 'Admin' && $model->username !== Yii::$app->user->id) {
            throw new ForbiddenHttpException('Anda tidak berwenang menghapus post ini.');
        }

        $model->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested post does not exist.');
    }
}
