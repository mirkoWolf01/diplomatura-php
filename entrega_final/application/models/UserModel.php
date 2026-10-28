<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserModel extends CI_Model {

    public function create_user(string $nombre, string $mail, string $password) {
        $datos = array(
            'nombre'   => $nombre,
            'mail'    => $mail,
            'contraseña' => $password,
        );
        $this->db->insert('usuarios', $datos);
        return $this->db->insert_id();
    }

    public function get_by_mail(string $mail) {
        $this->db->where('mail', $mail);
        $query = $this->db->get('usuarios');
        return $query->row();
    }
}