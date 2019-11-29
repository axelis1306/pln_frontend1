<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();

        if ($this->session->userdata('id_role') != 1) {
            redirect('User');
        }
    }


    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();
        // $id_notif = $new_notif[0]['id_notification'];
        // print_r($data['notif']);
        // $ab = $this->db->get_where('notification', ['id_notification' => $id_notif])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/index', $data);
        $this->load->view('templates/footer');
    }

    public function role()
    {
        $data['title'] = 'Role';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->M_Auth->getUserRole();
        $data['notif'] = get_new_notif();

        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('admin/role', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Admin->addRole(['role_type' => $this->input->post('role')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Menu Added</div>');
            redirect('admin/role');
        }
    }

    public function roleAccess($id_role)
    {
        $data['title'] = 'Role Access';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->M_Auth->getUserRoleById($id_role);
        $data['menu'] = $this->M_Auth->getUserMenuById(1);
        $data['notif'] = get_new_notif();

        // print_r($data['menu']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/role-access', $data);
        $this->load->view('templates/footer');
    }

    public function changeAccess()
    {
        $id_menu = $this->input->post('menuId');
        $id_role = $this->input->post('roleId');

        $data = [
            'id_role' => $id_role,
            'id_user_menu' => $id_menu
        ];

        $result = $this->M_Auth->getUserAccessMenuBy($data)->result();


        if (sizeof($result) < 1) {
            $this->M_Auth->addUserAccessMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Added</div>');
        } else {
            $this->M_Auth->deleteUserAccessMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            Access Deleted</div>');
        }
    }

    public function deleteRole($id_role)
    {
        if ($id_role == 1) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
            Administrator can\'t be Deleted</div>');
            redirect('admin/role');
        } else {
            $role = $this->M_Admin->getRoleById($id_role);
            $role_type = $role['role_type'];

            $this->M_Admin->deleteRoleById($id_role);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Role ' . $role_type . ' has been Deleted</div>');

            redirect('admin/role');
        }
    }

    public function notification()
    {
        $data['title'] = 'Notification';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();
        // $id_notif = $new_notif[0]['id_notification'];
        // print_r($data['notif']);
        // $ab = $this->db->get_where('notification', ['id_notification' => $id_notif])->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('admin/notification', $data);
        $this->load->view('templates/footer');
    }
}
