<?php
date_default_timezone_set('America/Bogota');

defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author:     John Arley Cano Salinas
 * Fecha:       19 de enero de 2018
 * Programa:    Uso de vía | Módulo de solicitudes
 *              Permite gestionar las 
 *              solicitudes de uso de vía
 * Email:       johnarleycano@hotmail.com
 */
class Solicitud extends CI_Controller {
    /**
     * Función constructora de la clase. Se hereda el mismo constructor 
     * de la clase para evitar sobreescribirlo y de esa manera 
     * conservar el funcionamiento de controlador.
     */
    function __construct() {
        parent::__construct();

        // Carga de modelos
        $this->load->model(array('configuracion_model', 'solicitud_model'));
    }
    
	/**
     * Interfaz inicial
     * 
     * @return [void]
     */
	function crear()
	{
        $this->data['titulo'] = 'Crear solicitud';
        $this->data['contenido_principal'] = 'solicitudes/crear';
        $this->load->view('core/template', $this->data);
	}

    /**
     * Permite la inserción de datos en la base de datos 
     * 
     * @return [void]
     */
    function insertar()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            // Datos vía POST
            $datos = $this->input->post('datos');
            $tipo = $this->input->post('tipo');

            switch ($tipo) {
                case "solicitud":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        } // if
    }
}
/* Fin del archivo Solicitudes.php */
/* Ubicación: ./application/controllers/Solicitudes.php */