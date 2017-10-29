<?php
namespace App;
require_once __DIR__ . '/vendor/autoload.php';

class Bootstrap {

    public function render()
    {
        ob_start();
        include(__DIR__ . '/index.html');
        $content = ob_get_contents();
        ob_end_clean();
        echo $content;
    }
}
