<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot/app';
    public $baseUrl = '@web';
    public $css = [
        'css/soc-site.css',
        'aos/aos.css',
        'viewerjs/viewer.min.css'
        // 'css/style.css',
        // 'vendors/ti-icons/css/themify-icons.css'
    ];
    public $js = [
        'js/soc-main.js',
        'viewerjs/viewer.min.js',
        // 'sweetalert2/dist/sweetalert2.all.min.js',
        'js/easy.qrcode.min.js',
        '/js-signature/signature_pad.min.js',
        'aos/aos.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
