
<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\widgets\Alert;
use app\assets\AppAsset;
use yii\helpers\Url;

AppAsset::register($this);
use hscstudio\mimin\components\Mimin;

$menuItems =
    [
    [
        'visible' => !Yii::$app->user->isGuest,
        'label' => 'Manajemen User / Group',
        'icon' => 'fa fa-share',
        'url' => '#',
        'items' => [
            ['label' => 'App. Route', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/route/'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'Role', 'icon' => 'fa fa-circle-o', 'url' => ['/mimin/role/'], 'visible' => !Yii::$app->user->isGuest],
            ['label' => 'User', 'icon' => ' fa fa-circle-o', 'url' => ['/mimin/user'], 'visible' => !Yii::$app->user->isGuest],
        ],
     ],
     ['label' => 'Barang', 'icon' => ' fa fa-circle-o', 'url' => ['/barang'], 'visible' => !Yii::$app->user->isGuest],
     ['label' => 'Lokasi', 'icon' => ' fa fa-circle-o', 'url' => ['/lokasi'], 'visible' => !Yii::$app->user->isGuest],
];

if (!Yii::$app->user->isGuest) {
    if (Yii::$app->user->identity->username !== 'admin') {
        $menuItems = Mimin::filterMenu($menuItems);
    }
}
$this->title = 'SI PANAH';
 $path =Url::to(['/'], true);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/ico', 'href' => $path.'logo.png']);
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language; ?>">
<head>
    <meta charset="<?= Yii::$app->charset; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags(); ?>
    <title><?= Html::encode($this->title); ?></title>
    <?php $this->head(); ?>
</head>
<body>
<?php $this->beginBody(); ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'SI PANAH',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-left'],
        'items' => $menuItems,
    ]);

    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            [
                'label' => Yii::$app->user->isGuest ? 'Login' : 'Logout',
                'url' => [Yii::$app->user->isGuest ? 'site/login' : '/site/logout'],
                'linkOptions' => ['data-method' => 'post'],
            ],
        ],
    ]);

    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]); ?>
		<?= Alert::widget(); ?>
        <?= $content; ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Sistem Informasi Pengamanan Tanah <?= date('Y'); ?></p>

         <p class="pull-right">Pengunjung :
<script type="text/javascript">
var sc_project=11850053;
var sc_invisible=0;
var sc_security="e3818788";
var sc_https=1;
var scJsHost = (("https:" == document.location.protocol) ? "https://secure." :
"http://www.");
document.write("<sc"+"ript type='text/javascript' src='" + scJsHost+
"statcounter.com/counter/counter.js'></"+"script>");
</script>
<noscript><div class="statcounter"><img
class="statcounter" src="//c.statcounter.com/11850053/0/e3818788/0/" alt="Web
Analytics Made Easy - StatCounter"></div></noscript>
<!-- End of Statcounter Code --></p>
    </div>
</footer>

<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>