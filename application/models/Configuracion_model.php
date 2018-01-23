<?php 
Class Configuracion_model extends CI_Model{
	function __construct() {
        parent::__construct();

        /*
         * db_configuracion es la conexion a los datos de configuración de la aplicación, como lo son los sectores, vías,
         * tramos, entre otros.
         * Esta se llama porque en el archivo database.php la variable ['configuracion']['pconnect] esta marcada como false,
         * lo que quiere decir que no se conecta persistentemente sino cuando se le invoca, como en esta ocasión.
         */
        $this->db_configuracion = $this->load->database('configuracion', TRUE);
    }

    /**
     * Obtiene registros de base de datos
     * y los retorna a las vistas
     * 
     * @param  [string] $tipo Tipo de consulta que va a hacer
     * @param  [int]    $id   Id foráneo para filtrar los datos
     * 
     * @return [array]       Arreglo de datos
     */
    function obtener($tipo, $id = null)
    {
        switch ($tipo) {
            case "funcionarios":
                $this->db
                    ->select(array(
                        'f.Pk_Id',
                        'CONCAT(u.Nombres, " ", u.Apellidos) Nombre',
                        'c.Nombre Cargo'
                        ))
                    ->from('funcionarios f')
                    ->join('configuracion.usuarios u', 'f.Fk_Id_Usuario = u.Pk_Id')
                    ->join('configuracion.cargos c', 'u.Fk_Id_Cargo = c.Pk_Id')
                    ->order_by('Nombre');
                
                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->result();
            break;

            case "municipios":
                return $this->db_configuracion->order_by("Nombre")->get("municipios")->result();
            break;

            case "proyectos":
                return $this->db_configuracion->order_by("Nombre")->get("proyectos")->result();
            break;

            case "sectores_municipios":
                return $this->db_configuracion->order_by("Nombre")->where("Fk_Id_Municipio", $id)->get("sectores_municipios")->result();
            break;
        }
    }
}
/* Fin del archivo Configuracion_model.php */
/* Ubicación: ./application/models/Configuracion_model.php */
