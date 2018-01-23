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
    function index()
    {
        $this->data['titulo'] = 'Solicitudes';
        $this->data['contenido_principal'] = 'solicitudes/index.php';
        $this->load->view('core/template', $this->data);
    }
    
    /**
     * Carga de interfaces vía Ajax
     * 
     * @return [void]
     */
    function cargar_interfaz()
    {
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            $tipo = $this->input->post("tipo");

            switch ($tipo) {

                case "documentos":
                    $this->load->view("solicitudes/documentos/crear");
                break;

                case "general":
                    $this->load->view("solicitudes/general/crear");
                break;

                case "lista":
                    $this->load->view("solicitudes/listar");
                break;

                case "participantes":
                    $this->load->view("solicitudes/participantes/index");
                break;

                case "participantes_creacion":
                    $this->load->view("solicitudes/participantes/crear");
                break;

                case "participantes_listado":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/participantes/listar", $this->data);
                break;

                case "via":
                    $this->load->view("solicitudes/vias/crear");
                break;
            }
        } else {
            // Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }

	/**
     * Interfaz de creación de la solicitud
     * 
     * @return [void]
     */
	function crear()
	{
        $this->data['titulo'] = 'Crear solicitud';
        $this->data['contenido_principal'] = 'solicitudes/general/index';
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
                case "participante":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;

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
                case "participante":
                    print json_encode($this->solicitud_model->obtener($tipo, array("Fk_Id_Solicitud" => $this->input->post("id_solicitud"), "Fk_Id_Funcionario" => $this->input->post("id_funcionario"))));
                break;
            }
        } else {
            // Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }
}
/* Fin del archivo Solicitudes.php */
/* Ubicación: ./application/controllers/Solicitudes.php */