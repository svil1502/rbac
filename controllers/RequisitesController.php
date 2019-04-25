<?php

namespace app\controllers;

use app\models\Companies;
use Yii;
use app\models\Requisites;
use app\models\RequisitesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Companies as CompaniesAlias;

/**
 * RequisitesController implements the CRUD actions for Requisites model.
 */
class RequisitesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Requisites models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RequisitesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data_ = CompaniesAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->name;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
        ]);
    }

    /**
     * Displays a single Requisites model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Requisites model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Requisites();
        $data_ = CompaniesAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->name;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data' => $data]);
        }

        return $this->render('create', [
            'model' => $model,'data' => $data
        ]);
    }

    /**
     * Updates an existing Requisites model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_ = CompaniesAlias::find()->all();

        foreach ($data_ as $value) {
            $data[$value->id]=$value->name;
        }



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data' => $data]);
        }

        return $this->render('update', [
            'model' => $model, 'data' => $data,
        ]);
    }

    /**
     * Deletes an existing Requisites model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */


    public function actionProv($id)
    {
//        $model=  \app\models\Requisites::findOne($id);
        $model=  \app\models\Requisites::find()->where(['id_company'=>$id])->one();

        return \yii\helpers\Json::encode([
            'id'=>$model->id,
            'req'=>$model->req
        ]);


    }
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Requisites model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Requisites the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Requisites::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
