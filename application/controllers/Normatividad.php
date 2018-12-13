<?php
defined('BASEPATH') OR exit('El acceso directo a este archivo no está permitido');

/**
 * @author: 	John Arley Cano Salinas
 * Fecha: 		13 de diciembre de 2018
 * Programa:  	Uso de vía | Módulo de normatividad
 *            	Gestión de la normatividad aplicable a las
 *            	observaciones de las solicitudes de permisos de vía
 * Email: 		johnarleycano@hotmail.com
 */
class Normatividad extends CI_Controller {
	/**
	 * Función constructora de la clase. Se hereda el mismo constructor 
	 * de la clase para evitar sobreescribirlo y de esa manera 
     * conservar el funcionamiento de controlador.
	 */
	function __construct() {
        parent::__construct();

        // Carga de modelos
        $this->load->model(array('normatividad_model'));
    }

    /**
     * Interfaz de creación
     * 
     * @return [void]
     */
    function crear()
    {
        $this->data['titulo'] = 'Norma';
        $this->data["id"] = $this->uri->segment(3);
        $this->data['contenido_principal'] = 'normatividad/crear';
        $this->load->view('core/template', $this->data);
    }

    /**
     * Interfaz de visualización
     * 
     * @return [void]
     */
    function ver()
    {
        $this->data['titulo'] = 'Normatividad';
        $this->data['contenido_principal'] = 'normatividad/listar';
        $this->load->view('core/template', $this->data);
    }

    /**
     * Actualización de registros en base de datos
     * 
     * @return [void]
     */
    function actualizar()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            $datos = $this->input->post('datos');
            $tipo = $this->input->post('tipo');

            switch ($tipo) {
                case 'normatividad':
                   echo $this->normatividad_model->actualizar($tipo, $this->input->post('id'), $datos);
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
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
                case "normatividad":
                    // Se inserta el registro y log en base de datos
                    if ($this->normatividad_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }
}
/* Fin del archivo Normatividad.php */
/* Ubicación: ./application/controllers/Normatividad.php */