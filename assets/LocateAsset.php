<?php

namespace app\assets;

use yii\web\AssetBundle;

class LocateAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
      'js/locate.js',
      'js/geoPosition.js',
      'http://maps.google.com/maps/api/js?sensor=false',
    ];
    public $depends = [
    ];
}
