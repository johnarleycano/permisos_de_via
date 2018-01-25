<?php
defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author: 	John Arley Cano Salinas
 * Fecha: 		19 de enero de 2018
 * Programa:  	Uso de vía | Módulo de configuración
 *            	Permite configurar y parametrizar todas las opciones
 *             	de la aplicación
 * Email: 		johnarleycano@hotmail.com
 */
class Configuracion extends CI_Controller {
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
	 * Obtiene registros de base de datos
	 * y los retorna a las vistas
	 * 
	 * @return [vois]
	 */
	function obtener()
	{
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
        	$tipo = $this->input->post("tipo");
        	$id = $this->input->post("id");

        	switch ($tipo) {
				case "costados":
					print json_encode($this->configuracion_model->obtener($tipo, $id));
				break;

                case "sectores_municipios":
					print json_encode($this->configuracion_model->obtener($tipo, $id));
				break;

				case "vias":
					print json_encode($this->configuracion_model->obtener($tipo, $id));
				break;
			}
		} else {
            // Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
	}
}
/* Fin del archivo Configuracion.php */
/* Ubicación: ./application/controllers/Configuracion.php */