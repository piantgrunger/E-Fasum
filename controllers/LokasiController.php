<?php

namespace app\controllers;

use Yii;
use  yii\helpers\Json;
use app\models\Kecamatan;
use app\models\Kelurahan;
use app\models\Lokasi;
use app\models\Detlokasi;
use app\models\LokasiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * LokasiController implements the CRUD actions for Lokasi model.
 */
class LokasiController extends Controller
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
     * Lists all Lokasi models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LokasiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Lokasi model.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Lokasi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Lokasi();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailLokasi = Yii::$app->request->post('Detlokasi', []);
                if ($model->upload('gambar') && $model->save()) {
                    $transaction->commit();

                    return $this->redirect(['view', 'id' => $model->id_lokasi]);
                } else {
                    $transaction->rollBack();

                    return $this->render('create', [
                        'model' => $model,
                    ]);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
        } else {
            $model->id_propinsi = 63;
            $model->id_kota = 6372;
            $model_det = new Detlokasi();
            $model_det->posisi = 'Utara';
            $det_model[] = $model_det;
            $model_det = new Detlokasi();
            $model_det->posisi = 'Selatan';
            $det_model[] = $model_det;
            $model_det = new Detlokasi();
            $model_det->posisi = 'Timur';
            $det_model[] = $model_det;
            $model_det = new Detlokasi();
            $model_det->posisi = 'Barat';
            $det_model[] = $model_det;

            $model->detailLokasi = $det_model;

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Lokasi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->old_gambar = $model->gambar;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailLokasi = Yii::$app->request->post('Detlokasi', []);
                if ($model->upload('gambar') && $model->save()) {
                    $transaction->commit();

                    return $this->redirect(['view', 'id' => $model->id_lokasi]);
                } else {
                    $transaction->rollBack();

                    return $this->render('update', [
                        'model' => $model,
                    ]);
                }
            } catch (\Exception $ecx) {
                $transaction->rollBack();
                throw $ecx;
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Lokasi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param int $id
     *
     * @return mixed
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (\yii\db\IntegrityException  $e) {
            Yii::$app->session->setFlash('error', 'Data Tidak Dapat Dihapus Karena Dipakai Modul Lain');
        }

        return $this->redirect(['index']);
    }

    public function actionKelurahan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_propinsi = $_POST['depdrop_parents'];
            $out = Kelurahan::getDataBrowseKelurahan($id_propinsi);
            // the getDefaultSubCat function will query the database
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => '']);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    // THE CONTROLLER
    public function actionKecamatan()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id_propinsi = $_POST['depdrop_parents'];
            $out = Kecamatan::getDataBrowseKecamatan($id_propinsi);
            // the getDefaultSubCat function will query the database
            // and return the default sub cat for the cat_id
            echo Json::encode(['output' => $out, 'selected' => '']);

            return;
        }
        echo Json::encode(['output' => '', 'selected' => '']);
    }

    /**
     * Finds the Lokasi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param int $id
     *
     * @return Lokasi the loaded model
     *
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Lokasi::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionPeta($key)
    {
        return    $this->renderAjax('_map_modal', [
          'key' => $key,
        ]);
    }
}
