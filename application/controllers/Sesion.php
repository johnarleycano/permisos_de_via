<?php
date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author:     John Arley Cano Salinas
 * Fecha:       13 de febrero de 2018
 * Programa:    Uso de vía | Módulo de sesión
 *              Gestiona todo lo relacionado con el inicio
 *              y cierre de sesión del usuario
 * Email:       johnarleycano@hotmail.com
 */
class Sesion extends CI_Controller {
	/**
     * Función constructora de la clase. Se hereda el mismo constructor 
     * de la clase para evitar sobreescribirlo y de esa manera 
     * conservar el funcionamiento de controlador.
     */
    function __construct() {
        parent::__construct();

        // Carga de modelos
        $this->load->model(array('configuracion_model'));
    }

	/**
	 * Cierra la sesión y redirecciona
	 * 
	 * @return [void]
	 */
	function cerrar()
	{
        $this->session->sess_destroy();
	        
        $aplicacion = $this->configuracion_model->obtener("aplicacion", $this->config->item('id_aplicacion_sesion'));
        
        redirect("{$aplicacion->Url}index.php/sesion/iniciar/".$this->config->item('id_aplicacion'));
	}
}
/* Fin del archivo Sesion.php */
/* Ubicación: ./application/controllers/Sesion.php */