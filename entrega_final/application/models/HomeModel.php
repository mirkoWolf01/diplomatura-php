<?php
defined('BASEPATH') or exit('No direct script access allowed');

class HomeModel extends CI_Model
{
    /** @var CI_DB $db */

    public function get_all()
    {
        // SELECT * FROM clase3.productos
        $query = $this->db->get('productos');

        // Con $query->result(); traigo todos los registros
        return $query->result();
    }

    public function get_by(int $id)
    {
        $this->db->where('codigo_producto', $id);
        $query = $this->db->get('productos');

        // $query->row(); -> trae solo el registro que coincide con el ID
        return $query->row();
    }
}
