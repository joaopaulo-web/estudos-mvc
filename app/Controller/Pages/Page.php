<?php

namespace App\Controller\Pages;

use \App\Utils\View;

//  Controlador de páginas: Recebe as requisições que irão chegar na home do site e retorna para a view. Retorna a informação contida nas páginas.

class Page{

    /**
     * Método responsável por renderizar o topo da página
     * @return string
     */
    private static function getHeader(){
        return View::render('pages/header');
    }

    /**
     * Método responsável por renderizar o topo da página
     * @return string
     */
    private static function getFooter(){
        return View::render('pages/footer');
    }
    

    /**
     * Método responsável por retornar o conteúdo (view) da nossa página genérica
     * @return string
     */
    public static function getPage($title,$content){
        return View::render('pages/page',[
            'title' => $title,
            'header' => self::getHeader(),
            'footer' => self::getFooter(),
            'content' => $content
        ]);
    }
    
}