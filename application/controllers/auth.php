<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login PLN Layanan Premium';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            //Validasi Sukses
            $this->_login();
        }
    }

    private function _login()
    {
        $email = $this->input->post('email');
        $password = $this->input->post('password');
        $this->load->model("M_Auth");
        $user = $this->M_Auth->getUserByEmail($email);
        // $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            //usernya sudah registered
            if ($user['is_active'] == 1) {
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id_user' => $user['id_user'],
                        'email' => $user['email'],
                        'id_role' => $user['id_role'],
                        'name' => $user['name']
                    ];
                    $this->session->set_userdata($data);
                    if ($user['id_role'] == 1) {
                        redirect('Admin');
                    } else if ($user['id_role'] == 2) {
                        redirect('User');
                    } else if ($user['id_role'] == 3) {
                        redirect('accountexecutive');
                    } else if ($user['id_role'] == 4) {
                        redirect('planning');
                    } else if ($user['id_role'] == 5) {
                        redirect('construction');
                    } else if ($user['id_role'] == 6) {
                        redirect('manager');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Password!</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Email has not been Activated!</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Email is Not Registered!</div>');
            redirect('auth');
        }
    }

    public function registration()
    {
        if ($this->session->userdata('email')) {
            redirect('user');
        }

        //Untuk set rules Validasi Nama pada Form Registrasi
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        //Untuk set rules Validasi Email pada Form Validasi
        $this->form_validation->set_rules(
            'email',
            'Email',
            'required|trim|valid_email|is_unique[user.email]',
            [
                'is_unique' => 'This Email has already registered!'
            ]
        );
        //Untuk set rules Validasi Password dan Repeat Password pada Form Validasi
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            'matches' => 'Password Dont Match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() ==  false) {
            $data['title'] = 'PLN Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'email' => htmlspecialchars($this->input->post('email', true)),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'image' => 'default.jpg',
                'id_role' => 2,
                'is_active' => 1,
            ];
            $this->M_Auth->addUser($data);
            // $this->db->insert('user', $data);

            // $this->_sendEmail();

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Your Account has been Activated. Please Login</div>');
            redirect('auth');
        }
    }

    // private function _sendEmail()
    // {
    //     $config = [
    //         'protocol' => 'smtp',
    //         'smtp_host' => 'ssl://smtp.googlemail.com',
    //         'smtp_user' => 'rifat.ardiyansyah13@gmail.com',
    //         'smtp_password' => 'ajanyoman',
    //         'smtp_port' => 465,
    //         'mail_type' => 'html',
    //         'charset' => 'utf-8',
    //         'newline' => "\r\n",
    //     ];

    //     $this->load->library('email', $config);
    //     $this->email->initialize($config);

    //     $this->email->from('rifat.ardiyansyah13@gmail.com', 'Rifat Ardiyansyah');
    //     $this->email->to('rifat.ardiyansyah@gmail.com');
    //     $this->email->subject('Testing');
    //     $this->email->message('Hello World!');
    //     if ($this->email->send()) {
    //         return true;
    //     } else {
    //         echo $this->email->print_debugger();
    //         die;
    //     }
    // }

    public function forgotPassword()
    {
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/forgot-password');
            $this->load->view('templates/auth_footer');
        } else {
            $email = $this->input->post('email');
            // $user = $this->db->get_where('user', ['email', => $email])->row_array();

        }
    }


    public function logout()
    {
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('id_role');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            You have been Logged Out!</div>');
        redirect('auth');
    }

    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
