<?php
date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author:     John Arley Cano Salinas
 * Fecha:       12 de febrero de 2018
 * Programa:    Uso de vía | Módulo de reportes
 *              Permite gestionar los
 *              reportes del sistema
 * Email:       johnarleycano@hotmail.com
 */
class Reportes extends CI_Controller {
	/**
     * Función constructora de la clase. Se hereda el mismo constructor 
     * de la clase para evitar sobreescribirlo y de esa manera 
     * conservar el funcionamiento de controlador.
     */
    function __construct() {
        parent::__construct();
        require('system/libraries/PHPExcel.php');

        // Si no ha iniciado sesión, se redirige a la aplicación de configuración
        if(!$this->session->userdata('Pk_Id_Usuario')){
            redirect("sesion/cerrar");
        }

        // Carga de modelos y librerías
        $this->load->model(array('configuracion_model', 'solicitud_model'));
    }

	function excel()
	{
		// Suiche tipo
        switch ($this->uri->segment(3)) {
            case 'concepto':
                $this->data["id_solicitud"] = $this->uri->segment(4);
                $this->data["id_concepto"] = $this->uri->segment(5);
                $this->load->view("reportes/excel/concepto", $this->data);
            break;
        }
	}
}
/* Fin del archivo Reportes.php */
/* Ubicación: ./application/controllers/Reportes.php */