<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        ' https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css',
        'https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css',
    ];
    public $js = [
        'jlorente\datatables\assets\DataTablesAsset',
        'js/FileSaver.js',
        ' https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js',
        'https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js',
        'https://cdn.datatables.net/buttons/1.5.1/js/buttons.flash.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/pdfmake.min.js',
        'https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.32/vfs_fonts.js',
        'https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js',
        'https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
