<?php

namespace App\Controller\Pages; // onde estamos agora

use \App\Utils\View;
use \App\Model\Entity\Organization;

// Recebe as requisições que irão chegar na home do site e retorna para a view. Retorna a informação contida nas páginas
class Home extends Page{

    /**
     * Método responsável por retornar o conteúdo (view) da nossa home
     * @return string
     */
    public static function getHome(){

        $obOrganization = new Organization;

        //View da home
        $content =  View::render('pages/home',[
            'name' => $obOrganization -> name,
            'description' => $obOrganization -> description,
            'site' => $obOrganization -> site
        ]);

        //Retorna a view da página
        return parent::getPage('MVC', $content);
    }
    
}