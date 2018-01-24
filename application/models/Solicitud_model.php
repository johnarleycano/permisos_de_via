<?php 
Class Solicitud_model extends CI_Model{
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
     * Permite la inserción de datos en la base de datos 
     * 
     * @param  [string] $tipo  Tipo de inserción
     * @param  [array]  $datos Datos que se van a insertar
     * 
     * @return [boolean]        true, false
     */
    function insertar($tipo, $datos)
    {
        switch ($tipo) {
            case "participante":
                return $this->db->insert('participantes', $datos);
            break;

            case "solicitud":
                return $this->db->insert('solicitudes', $datos);
            break;
        }
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
            case "participante":
                return $this->db->where($id)->get("participantes")->row();
            break;

            case "participantes":
                $this->db
                    ->select(array(
                            "p.Pk_Id",
                            "p.Fk_Id_Solicitud",
                            "CONCAT(u.Nombres, ' ',u.Apellidos) Nombre",
                        ))
                    ->from('participantes p')
                    ->join('funcionarios f', 'p.Fk_Id_Funcionario = f.Pk_Id')
                    ->join('configuracion.usuarios u', 'f.Fk_Id_Usuario = u.Pk_Id')
                    ->where('p.Fk_Id_Solicitud', $id)
                    ->order_by('Nombre')
                ;

                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->result();
            break;
        }
    }
}