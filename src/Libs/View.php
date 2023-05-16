<?php
namespace Rycconsulting\GestorCertificados\Libs;
class View{

    static function render($view,$data=[]){

        ob_start();
        foreach($data as $key=>$item){
            $$key = $item;
        }
        require_once plugin_dir_path(__FILE__).'/../Views/'.$view.'.php';
        $embed = ob_get_clean();

        return $embed;

    }

}
?>
