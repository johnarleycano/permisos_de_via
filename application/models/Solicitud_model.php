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
            case 'elemento_solicitud':
                return $this->db->where("Pk_Id", $id)->update('elementos_solicitudes', $datos);
            break;

            case 'lista_chequeo':
                return $this->db->where($datos)->update('listas_chequeo', $id);
            break;

            case 'solicitud':
                return $this->db->where("Pk_Id", $id)->update('solicitudes', $datos);
            break;
        }
    }

    /**
     * Elimina registros en base de datos
     * 
     * @param  [string] $tipo [Tipo de elemento a eliminar]
     * @param  [int] $id   [Id de la base de datos]
     * @return [boolean] true, false
     */
    function eliminar($tipo, $id){
        switch ($tipo) {
            case 'bitacora':
                return $this->db->delete('bitacora', $id);
            break;

            case 'lista_chequeo':
                return $this->db->delete('listas_chequeo', $id);
            break;

            case 'pago':
                return $this->db->delete('pagos', $id);
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
            case "bitacora":
                return $this->db->insert('bitacora', $datos);
            break;

            case "concepto":
                return $this->db->insert('conceptos', $datos);
            break;

            case "elemento_solicitud":
                return $this->db->insert('elementos_solicitudes', $datos);
            break;

            case "lista_chequeo":
                return $this->db->insert('listas_chequeo', $datos);
            break;

            case "pago":
                return $this->db->insert('pagos', $datos);
            break;

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
            case "bitacora":
                return $this->db->order_by("Fecha_Registro", "DESC")->where("Fk_Id_Solicitud", $id)->get("bitacora")->result();
            break;

            case "concepto":
                return $this->db->where("Pk_Id", $id)->get("conceptos")->row();
            break;

            case "conceptos":
                return $this->db->where("Fk_Id_Solicitud", $id)->get("conceptos")->result();
            break;

            case "elemento_solicitud":
                return $this->db->where($id)->get("elementos_solicitudes")->row();
            break;
            
            case "pago":
                return $this->db->where("Fk_Id_Solicitud", $id)->get("pagos")->row();
            break;

            case "participante":
                return $this->db->where($id)->get("participantes")->row();
            break;

            case "participantes":
                $this->db
                    ->select(array(
                            "p.Pk_Id",
                            "CONCAT(u.Nombres, ' ',u.Apellidos) Nombre",
                            "u.Documento",
                            "c.Nombre Cargo",
                            "f.Fk_Id_Empresa",
                            "f.Fk_Id_Interventoria",
                        ))
                    ->from('participantes p')
                    ->join('funcionarios f', 'p.Fk_Id_Funcionario = f.Pk_Id')
                    ->join('configuracion.usuarios u', 'f.Fk_Id_Usuario = u.Pk_Id')
                    ->join('configuracion.cargos c', 'u.Fk_Id_Cargo = c.Pk_Id')
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
                        "m.Nombre Municipio",
                        "p.Nombre Proyecto",
                        "p.Numero_Contrato",
                        "e.Nombre Empresa",
                        "i.Nombre Interventoria",
                        "i.Numero_Contrato Numero_Contrato_Interventoria",
                        "ts.Nombre Tipo",
                    ))
                    ->from('solicitudes s')
                    ->join('tipos_solicitudes ts', 's.Fk_Id_Tipo_Solicitud = ts.Pk_Id', 'left')
                    ->join('configuracion.sectores_municipios se', 's.Fk_Id_Sector = se.Pk_Id', 'left')
                    ->join('configuracion.municipios m', 'se.Fk_Id_Municipio = m.Pk_Id', 'left')
                    ->join('configuracion.proyectos p', 's.Fk_Id_Proyecto = p.Pk_Id', 'left')
                    ->join('configuracion.empresas e', 'p.Fk_Id_Empresa = e.Pk_Id', 'left')
                    ->join('configuracion.interventorias i', 'p.Fk_Id_Interventoria = i.Pk_Id', 'left')
                    ->where('s.Pk_Id', $id)
                ;

                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->row();
            break;

            case "solicitudes":
                return $this->db->order_by("Fecha", "DESC")->get("solicitudes")->result();
            break;

            case "tipos_documentos":
                return $this->db->order_by("Orden")->get("tipos_documentos")->result();
            break;

            case "valor_lista_chequeo":
                return $this->db->where($id)->get("listas_chequeo")->row();
            break;

            case 'vias':
                $this->db
                    ->select(array(
                            "s.Codigo Sector",
                            "cv.Nombre Via",
                            "cv.Codigo",
                            "cv.Categoria",
                            "tc.Pk_Id Fk_Id_Tipo_Costado",
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
                ;

                // return $this->db->get_compiled_select(); // string de la consulta
                return $this->db->get()->result();
            break;
        }
    }
}