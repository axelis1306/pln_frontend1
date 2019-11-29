<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public  function index()
    {
        $data['title'] = 'Menu Manajemen';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();

        $data['menu'] = $this->M_Auth->getUserMenu();

        $this->form_validation->set_rules('menu', 'Menu', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/index', $data);
            $this->load->view('templates/footer');
        } else {
            $this->M_Auth->addUserMenu(['menu' => $this->input->post('menu')]);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Menu Added</div>');
            redirect('menu');
        }
    }


    public function subMenu()
    {
        $data['rowidsm'] = $this->input->post('rowidsm');
        $data['title'] = 'Submenu Manajemen';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();
        $data['menu'] = $this->M_Auth->getUserMenu();
        $data['subMenu'] = $this->M_Menu->getSubMenu();

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id_user_menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');

        // if (isset($_POST['form_type'])) {
        //     // else if ($_POST['form_type'] == 'edit-submenu') {
        //     echo 'success';
        //     // print_r($data['submenu_row']);
        //     // }
        // } else {
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('menu/submenu', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'title' => $this->input->post('title'),
                'id_user_menu' => $this->input->post('id_user_menu'),
                'url' => $this->input->post('url'),
                'icon' => $this->input->post('icon'),
                'is_active_menu' => $this->input->post('is_active_menu')
            ];
            $this->M_Auth->addUserSubMenu($data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Sub Menu Added</div>');
            redirect('menu/submenu');
            // }
        }
    }

    public function editSubMenu()
    {
        // print_r($_POST['rowidsm']);
        $id = $_POST['rowidsm'];
        $menu = $_POST['rowmenu'];
        $data['id'] = $id;
        $data['rowmenu'] = $menu;
        $data['submenu_row'] = $this->M_Menu->getSubMenuById($id);
        $data['menu'] = $this->M_Menu->getUserMenu();
        // // print_r($data['submenu_row']);
        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('id_user_menu', 'Menu', 'required');
        $this->form_validation->set_rules('url', 'URL', 'required');
        $this->form_validation->set_rules('icon', 'Icon', 'required');
        $this->form_validation->set_rules('is_active_menu', 'Is Active Menu', 'required');

        if ($this->form_validation->run() == false) {
            // print_r($data['rowmenu']);
            $this->load->view('menu/edit-submenu', $data);
            // } else {
            //     $title = $this->input->post('title');
            //     $id_user_menu = $this->input->post('id_user_menu');
            //     $url = $this->input->post('url');
            //     $icon = $this->input->post('icon');
            //     $is_active_menu = $this->input->post('is_active_menu');
            //     print_r($title);
            //     $data = [
            //         'title' => $title,
            //         'id_user_menu' => $id_user_menu,
            //         'url' => $url,
            //         'icon' => $icon,
            //         'is_active_menu' => $is_active_menu
            //     ];
            //     // $this->db->set($data);

            //     // return array($id, $data);
            //     $this->db->where('id_user_sub_menu', $id);
            //     $this->db->update('user_sub_menu', $data);

            //     $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
            //     //                 Sub Menu has been updated</div>');
            //     redirect('menu/subMenu');
        }
    }
    public function submitEditSubmenu()
    {
        // echo "sukses";
        $id = $_POST['rowidsm'];
        $title = $this->input->post('title');
        $id_user_menu = $this->input->post('id_user_menu');
        $url = $this->input->post('url');
        $icon = $this->input->post('icon');
        $is_active_submenu = $this->input->post('is_active_submenu');
        // print_r($is_active_submenu);
        // print_r($title);
        $data = [
            'title' => $title,
            'id_user_menu' => $id_user_menu,
            'url' => $url,
            'icon' => $icon,
            'is_active_menu' => $is_active_submenu
        ];
        // $this->db->set($data);

        // return array($id, $data);
        $this->db->where('id_user_sub_menu', $id);
        $this->db->update('user_sub_menu', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Sub Menu has been updated</div>');
        redirect('menu/subMenu');
    }
}
