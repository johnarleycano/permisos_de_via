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
     * Actualiza los registros en base de datos
     * 
     * @param  [string]     $tipo       [tipo de actualización]
     * @param  [typeint]    $id         [Id del registro actualizar]
     * @param  [string]     $datos      [Arreglo con datos a actualizar]
     * 
     * @return [boolear]        [true, false]
     */
    function actualizar($tipo, $id, $datos){
        switch ($tipo) {
            case 'solicitud':
                return $this->db->where("Pk_Id", $id)->update('solicitudes', $datos);
            break;
        }
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
            
            case "via":
                return $this->db->insert('vias', $datos);
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

            case "solicitud":
                $this->db
                    ->select(array(
                        "s.*",
                        "se.Nombre Sector",
                        "se.Fk_Id_Municipio",
                    ))
                    ->from('solicitudes s')
                    ->join('configuracion.sectores_municipios se', 's.Fk_Id_Sector = se.Pk_Id')
                    ->where('s.Pk_Id', $id)
                ;

                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->row();
            break;

            case "solicitudes":
                return $this->db->order_by("Fecha", "DESC")->get("solicitudes")->result();
            break;

            case 'vias':
                $this->db
                    ->select(array(
                            "s.Codigo Sector",
                            "cv.Nombre Via",
                            "tc.Nombre Costado",
                            "sv.Abscisa_Inicial",
                            "sv.Abscisa_Final" 
                        ))
                    ->from('vias sv')
                    ->join('configuracion.costados c', 'sv.Fk_Id_Costado = c.Pk_Id')
                    ->join('configuracion.vias cv', 'c.Fk_Id_Via = cv.Pk_Id')
                    ->join('configuracion.sectores s', 'cv.Fk_Id_Sector = s.Pk_Id')
                    ->join('configuracion.tipos_costados tc', 'c.Fk_Id_Tipo_Costado = tc.Pk_Id')
                    ->where('sv.Fk_Id_Solicitud', $id)
                    // ->order_by('Nombre')
                ;

                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->result();
            break;
        }
    }
}