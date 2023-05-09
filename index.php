<?php

require __DIR__.'/vendor/autoload.php';

use \App\Controller\Pages\Home; // inclui o controlador de página home

echo Home::getHome(); // mostra na tela o método getHome, que está localizado em no controlador de Página Home.