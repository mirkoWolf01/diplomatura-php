<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public UserModel $UserModel;
    public CI_Form_validation $form_validation;
    public CI_Session $session;
    public CI_Input $input;

    public function __construct() {
        parent::__construct();
        $this->load->model('UserModel');
    }

    public function register() {
        if ($this->session->userdata('usuario')) {
            redirect('/');
        }

        $this->form_validation->set_rules('nombre', 'Nombre', 'required|min_length[3]|max_length[30]|alpha_numeric', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'El campo %s necesita al menos 3 caracteres.',
            'max_length' => 'El campo %s admite hasta 30 caracteres.',
            'alpha_numeric' => 'El campo %s debe tener unicamente characteres alfa-numericos'
        ));

        $this->form_validation->set_rules('mail', 'Email', 'required|valid_email|is_unique[usuarios.mail]', array(
            'required'    => 'El campo %s es obligatorio.',
            'valid_email' => 'Escribí un %s válido (ej: nombre@correo.com).',
            'is_unique'   => 'Ese mail ya está registrado.'
        ));
        $this->form_validation->set_rules('password', 'Contraseña', 'required|min_length[6]|alpha_numeric', array(
            'required'   => 'El campo %s es obligatorio.',
            'min_length' => 'La %s necesita al menos 6 caracteres.',
            'alpha_numeric' => 'El campo %s debe tener unicamente characteres alfa-numericos'
        ));

        $this->form_validation->set_rules('password-confirmation', 'Confirmar Contraseña', 'required|matches[password]|alpha_numeric', array(
            'required' => 'Debes de confirmar la contraseña.',
            'matches'  => 'Las contraseñas no coinciden.',
            'alpha_numeric' => 'El campo %s debe tener unicamente characteres alfa-numericos'
        ));

        if ($this->form_validation->run() == FALSE) {
            $datos['titulo'] = 'Crear cuenta';
            $this->load->view('auth_register', $datos);
        } else {
            $hashedPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT);

            $this->UserModel->create_user(
                $this->input->post('nombre'),
                $this->input->post('mail'),
                $hashedPassword
            );

            $this->session->set_flashdata('exito', '¡Cuenta creada! Ya podés iniciar sesión.');
            redirect('auth/login');
        }
    }

    public function login() {
        if ($this->session->userdata('usuario')) {
            redirect('/');
        }

        $this->form_validation->set_rules('mail', 'Email', 'required|valid_email', array(
            'required'    => 'El campo %s es obligatorio.',
            'valid_email' => 'Escribí un %s válido.'
        ));
        $this->form_validation->set_rules('password', 'Contraseña', 'required|alpha_numeric', array(
            'required' => 'El campo %s es obligatorio.',
            'alpha_numeric' => 'El campo %s debe tener unicamente characteres alfa-numericos'
        ));

        $datos['titulo'] = 'Iniciar sesión';

        if ($this->form_validation->run() == FALSE) {
            if ($this->input->method() === 'post') {
                $validationLogMessage = 'Fallo de validación en login: ' . strip_tags(validation_errors());
                log_message('error', $validationLogMessage);
            }
            $this->load->view('auth_login', $datos);
            return;
        }

        $usuario = $this->UserModel->get_by_mail($this->input->post('mail'));

        if ($usuario && password_verify($this->input->post('password'), $usuario->contraseña)) {
            $this->session->sess_regenerate(TRUE);

            $this->session->set_userdata('usuario', array(
                'id'     => $usuario->id_usuario,
                'nombre' => $usuario->nombre,
                'mail'  => $usuario->mail,
            ));
            redirect('/');
        }

        $errorMessage = 'Login fallido para el email: ' . $this->input->post('mail');
        log_message('error', $errorMessage);

        $datos['error'] = 'Email o contraseña incorrectos.';
        $this->load->view('auth_login', $datos);
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('/');
    }
}