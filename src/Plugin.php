<?php
namespace Rycconsulting\GestorCertificados;

use Rycconsulting\GestorCertificados\Controllers\CertificadoController;
use Rycconsulting\GestorCertificados\Libs\Database;
use Rycconsulting\GestorCertificados\Libs\ShortCodesRepository;
use Rycconsulting\GestorCertificados\Libs\View;
use Rycconsulting\GestorCertificados\Models\Certificado;
use Rycconsulting\GestorCertificados\Models\ShortCode;

class Plugin{   

    public ShortCodesRepository $shortcodes;

    function __construct()
    {
        $this->shortcodes = new ShortCodesRepository;
    }

    public function start()
    {
        add_action('admin_menu',[$this,'addAdminPage']);
        
    }

    public function addAdminPage()
    {
        
        add_menu_page('Buscador de Certificados','Buscador de certificados','manage_options','buscador-certificados-rc',function(){
            $existCertificadosTable = (new Certificado)->validTable('certificado');
            $existAlumnoTable = (new Certificado)->validTable('alumno');
            $db = new Database();
            $embed = View::render('manage',['existCertificadosTable'=>$existCertificadosTable,'existAlumnosTable'=>$existAlumnoTable,'db'=>$db,'shortcodes'=>$this->shortcodes->items]);
            echo View::render('template',['embed'=>$embed]);
        });
        

    }

    public function addShortcodes()
    {
        $sc_loadform = new ShortCode();
        $sc_loadform->description = "Shortcode para cargar el formulario de búsqueda";
        $sc_loadform->shortcode = "add_form_certificados_rc";
        $sc_loadform->callback = function(){
            $this->loadForm();
        };

        $sc_loadResults = new ShortCode();
        $sc_loadResults->description = "Shortcode para cargar resultados de búsqueda";
        $sc_loadResults->shortcode = "add_results_certificados_rc";
        $sc_loadResults->callback = function(){
            $this->loadResults();
        };

        $this->shortcodes->load($sc_loadform,$sc_loadResults);
    }

    public function loadForm()
    {
        echo View::render('form');
    }

    public function loadResults()
    {
        $results =  [];
        echo View::render('results',['results'=>$results]);
    }

    public function loadSrc(){
        wp_register_style('PluginBuscadorCert_rc_css',plugin_dir_url(__FILE__).'resources/css/app.css');
        wp_register_style('PluginBuscadorCert_rc_css_modal',"https://cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css");
        wp_register_style('PluginBuscadorCert_rc_css_datatable',"https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css");


        wp_register_script('PluginBuscadorCert_rc_jquery',"https://code.jquery.com/jquery-3.7.0.min.js",array('jquery'), '1.0', true );
        wp_register_script('PluginBuscadorCert_rc_modal', "https://cdn.jsdelivr.net/npm/sweetalert2@11");
        wp_register_script('PluginBuscadorCert_rc_datatable', "https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js");
        wp_register_script('PluginBuscadorCert_rc_js',plugin_dir_url(__FILE__).'resources/js/app.js');
        
        
        wp_enqueue_style('PluginBuscadorCert_rc_css');
        wp_enqueue_style('PluginBuscadorCert_rc_css_modal');
        wp_enqueue_style('PluginBuscadorCert_rc_css_datatable');

        wp_enqueue_script( 'PluginBuscadorCert_rc_jquery');
        wp_enqueue_script( 'PluginBuscadorCert_rc_modal');
        wp_enqueue_script( 'PluginBuscadorCert_rc_datatable');

        wp_enqueue_script('PluginBuscadorCert_rc_js');
        wp_localize_script( 'PluginBuscadorCert_rc_js', 'ajax_object',
            array( 'url' => admin_url( 'admin-ajax.php' ) ) );
        
    }

    public function loadAjax()
    {
        add_action( 'wp_ajax_find_certificados_by_dni_ryc', [$this,'findCertificadosByDni']);
       
    }

    public function findCertificadosByDni()
    {
        
        if(isset($_POST)){
            
            $results = (new CertificadoController)->findByDni($_POST['dni']);
            echo json_encode($results);
            wp_die();
        }
    }
}
