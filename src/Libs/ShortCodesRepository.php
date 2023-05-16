<?php
namespace Rycconsulting\GestorCertificados\Libs;

use Rycconsulting\GestorCertificados\Models\ShortCode;

class ShortCodesRepository{

    public $items;

    public function load(ShortCode ...$shortcodes)
    {
        
        foreach($shortcodes as $shortcode){
            add_shortcode($shortcode->shortcode,$shortcode->callback);
        }
        $this->items = $shortcodes;
    }

}
?>