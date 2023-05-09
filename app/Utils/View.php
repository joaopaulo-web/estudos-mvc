<?php

namespace App\Utils;
 
class View{

    /**
     * Método responsável por retornar o conteudo de uma view
     * @param string
     * @return string   
     */
    private static function getContentView($view){
        $file = __DIR__.'/../../resources/view/'.$view.'.html'; 
        // resultará em arquivos tipo home.html, produtos.html
        return file_exists($file) ? file_get_contents($file) : '';
    }

    /**
     * Método responsável por retornar um conteudo renderizado de uma view
     * @param string $view
     * @param array $vars (string/numeric)
     * @return string
     */
    public static function render($view, $vars = []){
        //Conteudo da view

        $contentView = self::getContentView($view);

        //DEscobre chaves dos arrays de variáveis

        $keys = array_keys($vars);
        $keys = array_map(function($item){
            return '{{'.$item.'}}';
        },$keys);

        // retorna o conteudo renderizado
        return str_replace($keys, array_values($vars),$contentView);
    }

}