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

        // Si no ha iniciado sesión, se redirige a la aplicación de configuración
        if(!$this->session->userdata('Pk_Id_Usuario')){
            redirect("sesion/cerrar");
        }
    }

    /**
     * Interfaz de creación de la solicitud
     * 
     * @return [void]
     */
    function index()
    {
        $this->data['titulo'] = 'Crear solicitud';
        $this->data['contenido_principal'] = 'solicitudes/index';
        $this->load->view('core/template', $this->data);
    }
    
    /**
     * Interfaz de visualización
     * 
     * @return [void]
     */
    function ver()
    {
        $this->data['titulo'] = 'Solicitudes';
        $this->data['contenido_principal'] = 'solicitudes/listar';
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
                case 'elemento_solicitud':
                   echo $this->solicitud_model->actualizar($tipo, $this->input->post('id'), $datos);
                break;

                case 'lista_chequeo':
                   echo $this->solicitud_model->actualizar($tipo, $this->input->post('valor'), $datos);
                break;

                case 'solicitud':
                   echo $this->solicitud_model->actualizar($tipo, $this->input->post('id_solicitud'), $datos);
                break;
            }
        }else{
            //Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
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
                case "conceptos":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/conceptos/index", $this->data);
                break;

                case "general":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/index", $this->data);
                break;

                case "general_bitacora":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/bitacora/index", $this->data);
                break;

                case "general_bitacora_crear":
                    $this->load->view("solicitudes/general/bitacora/crear");
                break;

                case "general_bitacora_lista":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/bitacora/listar", $this->data);
                break;

                case "general_chequeo":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/chequeo/index", $this->data);
                break;

                case "general_chequeo_documento":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->data["id_tipo"] = $this->input->post("id_tipo");
                    $this->load->view("solicitudes/general/chequeo/documento", $this->data);
                break;

                case "general_chequeo_listado":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/chequeo/listar", $this->data);
                break;

                case "general_chequeo_observacion":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->data["id_tipo"] = $this->input->post("id_tipo");
                    $this->load->view("solicitudes/general/chequeo/observacion", $this->data);
                break;

                case "general_elementos":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/elementos/index", $this->data);
                break;

                case "general_elementos_crear":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/elementos/crear", $this->data);
                break;

                case "general_informacion":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/informacion_general", $this->data);
                break;

                case "general_participantes":
                    $this->load->view("solicitudes/general/participantes/index");
                break;

                case "general_participantes_crear":
                    $this->load->view("solicitudes/general/participantes/crear");
                break;

                case "general_participantes_lista":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/participantes/listar", $this->data);
                break;

                case "general_peticionario":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/peticionario", $this->data);
                break;

                case "general_vias":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/vias/index", $this->data);
                break;

                case "general_vias_crear":
                    $this->load->view("solicitudes/general/vias/crear");
                break;

                case "general_vias_lista":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/general/vias/listar", $this->data);
                break;

                case "pago":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/pago/index", $this->data);
                break;

                case "pago_aceptacion":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/pago/aceptacion", $this->data);
                break;

                case "pago_facturacion":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/pago/facturacion", $this->data);
                break;

                case "pago_solicitud":
                    $this->data["id_solicitud"] = $this->input->post("id_solicitud");
                    $this->load->view("solicitudes/pago/solicitud", $this->data);
                break;
            }
        } else {
            // Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }

    /**
     * Elimina registros en base de datos
     * 
     * @return [boolean] true, false
     */
    function eliminar(){
        //Se valida que la peticion venga mediante ajax y no mediante el navegador
        if($this->input->is_ajax_request()){
            // Datos por POST
            $tipo = $this->input->post("tipo");

            switch ($tipo) {
                case 'bitacora':
                    echo $this->solicitud_model->eliminar($tipo, $this->input->post("datos"));
                break;

                case 'lista_chequeo':
                    echo $this->solicitud_model->eliminar($tipo, $this->input->post("datos"));
                break;

                case 'pago':
                    echo $this->solicitud_model->eliminar($tipo, $this->input->post("datos"));
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
                case "bitacora":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;

                case "concepto":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;

                case "elemento_solicitud":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) echo $this->db->insert_id();
                break;

                case "lista_chequeo":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;

                case "pago":
                    // Se inserta el registro y log en base de datos
                    if ($this->solicitud_model->insertar($tipo, $datos)) {
                        echo $id = $this->db->insert_id();
                    }
                break;

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
                
                case "via":
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
                case "conceptos":
                    print json_encode($this->solicitud_model->obtener($tipo, $id));
                break;

                case "elemento_solicitud":
                    print json_encode($this->solicitud_model->obtener($tipo, $id));
                break;

                case "elementos":
                    print json_encode($this->solicitud_model->obtener($tipo, $id));
                break;
                
                case "pago":
                    print json_encode($this->solicitud_model->obtener($tipo, $id));
                break;
                
                case "participante":
                    print json_encode($this->solicitud_model->obtener($tipo, array("Fk_Id_Solicitud" => $this->input->post("id_solicitud"), "Fk_Id_Funcionario" => $this->input->post("id_funcionario"))));
                break;
                
                case "solicitud":
                    print json_encode($this->solicitud_model->obtener($tipo, $id));
                break;
            }
        } else {
            // Si la peticion fue hecha mediante navegador, se redirecciona a la pagina de inicio
            redirect('');
        }
    }

    function subir()
    {
        // Se toman los datos por POST
        $id_solicitud = $this->uri->segment(3);
        $id_tipo = $this->uri->segment(4);

        // Se establece el directorio
        $directorio = "./archivos/documentacion/$id_solicitud";

        // Valida que el directorio exista. Si no existe,lo crea con el id obtenido
        // con los permisos correspondientes
        if( ! is_dir($directorio)){
            @mkdir($directorio, 0777);
        }

        if( ! is_dir("$directorio/$id_tipo")){
            @mkdir("$directorio/$id_tipo", 0777);
        }

        foreach ($_FILES as $key){
            if (move_uploaded_file($key['tmp_name']["0"], "$directorio/$id_tipo/{$key['name']['0']}")){
                print json_encode($key['name']);
            }
        }
    }
}
/* Fin del archivo Solicitudes.php */
/* Ubicación: ./application/controllers/Solicitudes.php */