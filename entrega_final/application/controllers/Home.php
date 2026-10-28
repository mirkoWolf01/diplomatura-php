<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public HomeModel $HomeModel;

    #[Override]
    public function __construct()
    {
        parent::__construct();
        $this->load->model("HomeModel");
        $this->load->library("form_validation");
    }

	public function index()
	{
		$datos['productos'] = $this->HomeModel->get_all();
        $this->load->view('home', $datos);

	}

    public function detalle_producto(int $id){
        $producto = $this->HomeModel->get_by($id);

        $datos['producto'] = $producto;
        $this->load->view('detalle_producto', $datos);
    }
}
