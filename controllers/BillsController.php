<?php

namespace app\controllers;

use Yii;
use app\models\Bills;
use app\models\BillsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Contracts as ContractsAlias;
use app\models\Acts as ActsAlias;

/**
 * BillsController implements the CRUD actions for Bills model.
 */
class BillsController extends Controller
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
     * Lists all Bills models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new BillsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $data_ = ContractsAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }
        $data_a = ActsAlias::find()->all();
        foreach ($data_a as $value) {
            $data_acts[$value->id]=$value->number;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'data' => $data,
            'data_acts' => $data_acts,
        ]);
    }

    /**
     * Displays a single Bills model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($id)
    {
        return $this->render('download', [
            'model' => $this->findModel($id),

        ]);

    }
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Bills model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Bills();
        $data_ = ContractsAlias::find()->all();
        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }
        $data_a = ActsAlias::find()->all();
        foreach ($data_a as $value) {
            $data_acts[$value->id]=$value->number;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id, 'data' => $data, 'data_acts' => $data_acts]);
        }

        return $this->render('create', [
            'model' => $model,  'data' => $data,
            'data_acts' => $data_acts,
        ]);
    }

    /**
     * Updates an existing Bills model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $data_ = ContractsAlias::find()->all();

        foreach ($data_ as $value) {
            $data[$value->id]=$value->number;
        }
        $data_a = ActsAlias::find()->all();
        foreach ($data_a as $value) {
            $data_acts[$value->id]=$value->number;
        }
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id,  'data' => $data,  'data_acts' => $data_acts]);
        }

        return $this->render('update', [
            'model' => $model,
            'data' => $data,
            'data_acts' => $data_acts
        ]);
    }

    /**
     * Deletes an existing Bills model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Bills model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Bills the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Bills::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
