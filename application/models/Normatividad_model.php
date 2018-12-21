<?php 
Class Normatividad_model extends CI_Model{
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
            case 'normatividad':
                return $this->db->where("Pk_Id", $id)->update('normas', $datos);
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
            case "normatividad":
                return $this->db->insert('normas', $datos);
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
        	case "norma":
    	        return $this->db
                    ->order_by("Numeral")
                    ->where("Pk_Id", $id)
                    ->get("normas")->row();
            break;

            case "normas":
                if($id) $this->db->where("Fk_Id_Resolucion", $id);
                
                $this->db
	                ->select(array(
	                	"n.*",
	                	"r.Numero Resolucion"
	                ))
	                ->from("normas n")
                    ->join('resoluciones r', 'n.Fk_Id_Resolucion = r.Pk_Id')
                ;

                return $this->db->get()->result();
            break;

            case "resoluciones":
    	        return $this->db
                    ->order_by("Numero")
                    ->get("resoluciones")->result();
            break;
        }
    }
}
/* Fin del archivo Normatividad_model.php */
/* Ubicación: ./application/models/Normatividad_model.php */