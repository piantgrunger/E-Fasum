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
use kartik\mpdf\Pdf;

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
                if ($model->upload('gambar')
                && $model->upload('gambar_pagar')
                && $model->upload('gambar_pondasi')
                && $model->upload('gambar_patok')
                && $model->upload('gambar_papan_nama')
                 && $model->save()) {
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
    public function actionPrint($id)
    {
        $content = $this->renderPartial('print', [
            'model' => $this->findModel($id),
        ]);

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
   // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Laporan '],
    // call mPDF methods on the fly
        ]);

        return  $pdf->render();
    }

    public function actionReport()
    {
        $model = Lokasi::find()->all();

        $content = $this->renderPartial('laporan', [
            'model' => $model,

        ]);
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
   // set to use core fonts only
            'mode' => Pdf::MODE_UTF8,
   // A4 paper format
            'format' => Pdf::FORMAT_A4,
   // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE,
   // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
   // your html content input
            'content' => $content,
   // format content from your own css file if needed or use the
   // enhanced bootstrap css built by Krajee for mPDF formatting
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
    // set mPDF properties on the fly
            'options' => ['title' => 'Cetak Laporan '],
    // call mPDF methods on the fly
        ]);

        return $pdf->render();
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->old_gambar = $model->gambar;
        $model->old_gambar_pagar = $model->gambar_pagar;
        $model->old_gambar_pondasi = $model->gambar_pondasi;
        $model->old_gambar_patok = $model->gambar_patok;
        $model->old_gambar_papan_nama = $model->gambar_papan_nama;

        if ($model->load(Yii::$app->request->post())) {
            $transaction = Yii::$app->db->beginTransaction();
            try {
                $model->detailLokasi = Yii::$app->request->post('Detlokasi', []);

                if ($model->upload('gambar')
                && $model->upload('gambar_pagar')
                && $model->upload('gambar_pondasi')
                && $model->upload('gambar_patok')
                && $model->upload('gambar_papan_nama')
                && $model->uploadDokumen()
                && $model->save()) {
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
