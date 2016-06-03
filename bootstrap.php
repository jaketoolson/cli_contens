<?php
ini_set('allow_url_include', 1);
ini_set('allow_url_fopen', 1);

require_once 'phar://app.phar/vendor/autoload.php';

/**
 *
 */
function checkPHPIni()
{
    if (! ini_get('allow_url_include') || ! ini_get('allow_url_fopen')) {
        var_dump(ini_get('allow_url_include'), ini_get('allow_url_fopen'));
        throw new RuntimeException('Must enable php settings: [allow_url_include] and [allow_url_fopen]');
    }
}