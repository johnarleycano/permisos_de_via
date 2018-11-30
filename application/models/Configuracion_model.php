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
            case "aplicacion":
                return $this->db_configuracion
                ->where("Pk_Id", $id)
                ->get("aplicaciones")->row();
            break;

            case "costados":
                $this->db_configuracion
                    ->select(array(
                        'c.Pk_Id',
                        'tc.Codigo',
                        'tc.Nombre',
                        ))
                    ->from('costados c')
                    ->join('tipos_costados tc', 'c.Fk_Id_Tipo_Costado = tc.Pk_Id')
                    ->where('c.Fk_Id_Via', $id)
                    ->order_by('Orden')
                ;
                
                // return $this->db_configuracion->get_compiled_select(); // string de la consulta
                return $this->db_configuracion->get()->result();
            break;

            case "elementos":
                return $this->db->get("elementos")->result();
            break;
            
            case 'formato_fecha':
                $fecha = $id;

                // Si la fecha toda es cero
                if ($fecha == "0000-00-00")  return "";

                // Si el día, el mes o el año están en ceros
                if (substr($fecha, 8, 2) == "00" || substr($fecha, 5, 2) == "00" || substr($fecha, 0, 4) == "0000") return "Fecha no válida";

                $dia_num = date("j", strtotime($fecha));
                $dia = date("N", strtotime($fecha));
                $mes = date("m", strtotime($fecha));
                $anio_es = date("Y", strtotime($fecha));

                //Si No hay fecha, devuelva vac&iacute;o en vez de 0000-00-00
                if($fecha == '1969-12-31 19:00:00' || !$fecha)  return false;

                //Nombres de los d&iacute;as
                if($dia == "1") $dia_es = "Lunes";
                if($dia == "2") $dia_es = "Martes";
                if($dia == "3") $dia_es = "Miercoles";
                if($dia == "4") $dia_es = "Jueves";
                if($dia == "5") $dia_es = "Viernes";
                if($dia == "6") $dia_es = "Sabado";
                if($dia == "7") $dia_es = "Domingo";

                //Nombres de los meses
                if($mes == "1") $mes_es = "Enero";
                if($mes == "2") $mes_es = "Febrero";
                if($mes == "3") $mes_es = "Marzo";
                if($mes == "4") $mes_es = "Abril";
                if($mes == "5") $mes_es = "Mayo";
                if($mes == "6") $mes_es = "junio";
                if($mes == "7") $mes_es = "Julio";
                if($mes == "8") $mes_es = "Agosto";
                if($mes == "9") $mes_es = "Septiembre";
                if($mes == "10") $mes_es = "Octubre";
                if($mes == "11") $mes_es = "Noviembre";
                if($mes == "12") $mes_es = "Diciembre"; 

                //Se foramtea la fecha
                // $fecha = $dia_num." de ".$mes_es." de ".$anio_es;
                return array("dia" => $dia_num, "mes_texto" => $mes_es, "anio" => $anio_es);
            break;
            
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

            case "sectores":
                return $this->db_configuracion
                    ->order_by("Codigo")
                    ->get("sectores")->result();
            break;

            case "sectores_activos":
                return $this->db_configuracion
                    ->where("Estado", 1)
                    ->order_by("Codigo")
                    ->get("sectores")->result();
            break;

            case "sectores_municipios":
                return $this->db_configuracion->order_by("Nombre")->where("Fk_Id_Municipio", $id)->get("sectores_municipios")->result();
            break;

            case "tipos_solicitudes":
                return $this->db->order_by("Orden")->get("tipos_solicitudes")->result();
            break;

            case "tramos":
                $this->db_configuracion
                    ->select(array(
                        "t.Pk_Id",
                        "CONCAT( t.Nombre, ' (Municipio de ', m.Nombre, ')' ) Nombre",
                        ))
                    ->from('tramos t')
                    ->join('municipios m', 't.Fk_Id_Municipio_Jurisdiccion = m.Pk_Id')
                    ->where('Fk_Id_Via', $id)
                    ->order_by('Nombre');
                
                // return $this->db_configuracion->get_compiled_select(); // string de la consulta
                return $this->db_configuracion->get()->result();
            break;

            case "vias":
                return $this->db_configuracion
                    ->order_by("Nombre")
                    ->get("vias")
                    ->result();
            break;
        }
    }
}
/* Fin del archivo Configuracion_model.php */
/* Ubicación: ./application/models/Configuracion_model.php */
