<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'My Profile';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->M_Auth->getUserRoleById($this->session->userdata('id_role'));
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function edit()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['role'] = $this->M_Auth->getUserRoleById('id_role');
        $data['notif'] = get_new_notif();

        $this->form_validation->set_rules('name', 'Full Name', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $name = $this->input->post('name');
            $email = $this->input->post('email');

            // Cek jika udah ada gambar
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.jpg') {
                        //FCPATH = Front Controller PATH. Gbs pake base_url karena harus alamat lengkapnya makanya pake FCPATH
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }


                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">' . $this->upload->display_errors() . '</div>');
                    redirect('user');
                }
            }

            $this->db->set('nama', $name);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Your Profile has been updated</div>');
            redirect('user');
        }
    }

    public function changePassword()
    {
        $data['title'] = 'Change Password';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();


        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password', 'required|trim|min_length[8]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Repeat New Password', 'required|trim|min_length[8]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/changepassword', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if (!password_verify($current_password, $data['user']['password'])) {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Wrong Current Password!</div>');
                redirect('user/changepassword');
            } else {
                if ($current_password == $new_password) {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    New Password can\'t be the same as Current Password!</div>');
                    redirect('user/changepassword');
                } else {
                    //Password sudah OK
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                    $this->db->set('password', $password_hash);
                    $this->db->where('email', $this->session->userdata('email'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Password Changed!</div>');
                    redirect('user/changepassword');
                }
            }
        }
    }

    public function report()
    {
        $data['title'] = 'Report';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['dropDown'] = $this->M_Report->getCustomer();
        $data['notif'] = get_new_notif();

        // print_r($data['customer']['name_customer']);
        // print_r($data['user']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/report', $data);
        $this->load->view('templates/footer');
    }

    public function uploadReport()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('dropDown');
        $reason = $this->input->post('report_reason');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");



        $data = array();
        if (!empty($_FILES['images']['name'][0])) {

            if ($this->upload_files($reportFolder, $userId, $custName, $_FILES['images']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $ReportData = [
                'id_user' => $userId,
                'id_customer' => $custId,
                'report_reason' => $reason,
                'report_time' => $reportFolder
            ];

            $this->M_Report->addUserReport($ReportData);
        } else { }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Report has been Saved!</div>');
        redirect('user/report');
    }

    private function upload_files($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/report/";

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }
        $reportDirectoryName = $structure . '/' . $custName . '/' . $date[0] . '-' . $date[1] . '-' . $date[2] . ' ' . $time[0] . '-' . $time[1];
        mkdir($reportDirectoryName, 0777);
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $images = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['images[]']['name'] = $files['name'][$key];
            $_FILES['images[]']['type'] = $files['type'][$key];
            $_FILES['images[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['images[]']['error'] = $files['error'][$key];
            $_FILES['images[]']['size'] = $files['size'][$key];

            $fileName =  $count;
            $count = $count + 1;
            $images[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('images[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }

        return $images;
    }

    public function monitoring()
    {
        $data['title'] = 'Monitoring';
        $data['customers'] = $this->M_Report->getCustomer();
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/monitoring', $data);
        $this->load->view('templates/footer');
    }

    public function getMonitoringList()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_Report->getCustomer();
        $data = array();
        $no = $start;
        foreach ($list as $at) {
            $no++;
            $data[] = [
                'no' => $no,
                'name_customer' => $at['name_customer'],
                'id_customer' => $at['id_customer'],
                'tariff/daya' => $at['tariff'] . '/' . $at['power'],
                'type_of_service' => $at['type_of_service'],
                'status' => $at['status'],
                'btn' => '<a href="' . $url . 'user/detailCustomer/' . $at['id_customer'] . '" class="badge badge-primary">Detail</a>'
            ];
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function detailCustomer($id_customer)
    {
        $data['title'] = 'Detail Report';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['report'] = $this->M_Report->getReportByIdCustomer($id_customer);
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();
        // $data_user = $data['report']['id_user'];
        // $data['user_report'] = $this->M_Auth->getUserById($data_user);
        // $data_role = $data['user_report']['id_role'];
        // $data['user_role'] = $this->M_Auth->getUserRoleById($data_role);
        // $data['customers'] =

        // print_r($data['report']);
        // print_r($data['user_role']);
        // print_r($data['report']['report_reason']);
        // $data['user_report'] = $this->M_Report->getUserReportByIdUser($data['report']);
        // $data['role'] = $this->M_Auth->getRole();
        // print_r($data['report']);
        // var_dump($data['report']['id_user']);
        // print_r($this->session->userdata('id_customer'));
        // print_r($id_customer);
        // if ($_POST['rowid']) {
        //     $id_user_report = $_POST['rowid'];
        //     $data['report_row'] = $this->M_Report->getReportById($id_user_report);
        // }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail-report', $data);
        $this->load->view('templates/footer');
    }

    public function getDetailCustomerData($id)
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_Report->getReportByIdCustomer($id);
        $data = array();
        $no = $start;
        foreach ($list as $at) {
            $no++;
            $data[] = [
                'no' => $no,
                'name' => $at['name'],
                'role_type' => $at['role_type'],
                'report_reason' => truncateText($at['report_reason']),
                'report_time' => $at['report_time'],
                'btn' => '<a href="#" class="btn btn-info btn-sm justify-content-end" data-toggle="modal" data-target="#detailReportModal" data-id="' . $at['id_user_report'] . '">See Detail</a>'
            ];
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function detailReport()
    {
        // print_r($_POST['rowid']);
        if ($_POST['rowid']) {
            $id = $_POST['rowid'];
            $data['report_row'] = $this->M_Report->getReportByIdUserReport($id);
            $this->load->view('user/detail-user-report', $data);
            // print_r($data['report_row']);
            // print_r($data['report_row']);
            // $data['customerss'] = $this->M_Report->getReportByIdCustomer();
            // print_r($id_customers);
        }
    }

    public function problemMapping()
    {
        // Form Validation Customers Profile
        $this->form_validation->set_rules('customer', 'Customer', 'required|trim');
        $this->form_validation->set_rules('address-customer', 'Address Customer', 'required|trim|min_length[20]', [
            'min_length' => 'Address at least 10 characters long'
        ]);
        $this->form_validation->set_rules('tariff', 'Tarif', 'required|trim|max_length[2]', [
            'max_length' => 'Maximum 2 characters'
        ]);
        $this->form_validation->set_rules('power', 'Daya', 'required|trim');
        $this->form_validation->set_rules('dropDown', 'Service', 'required');

        // Form Validation Company Profile
        $this->form_validation->set_rules('company-name', 'Company Name', 'required|trim');
        $this->form_validation->set_rules('address-company', 'Company Address', 'required|trim');
        $this->form_validation->set_rules('phone-company', 'Phone Company', 'required|trim');
        $this->form_validation->set_rules('facsimile', 'Facsimile', 'required');
        $this->form_validation->set_rules('email-company', 'Email Company', 'required|trim|is_unique[company_profile.email_company]');
        $this->form_validation->set_rules('establishment', 'Establishment', 'required');

        // Form Validation Info Chief
        $this->form_validation->set_rules('company-leader-name', 'Leader Name', 'required|trim');
        $this->form_validation->set_rules('leader-position-company', 'Leader Position', 'required|trim');
        $this->form_validation->set_rules('phone-leader-company', 'Leader Phone Number', 'required|trim');
        $this->form_validation->set_rules('email-leader-company', 'Leader Email', 'required|trim|valid_email|is_unique[company_leader.email]');

        // Form Validation Info Finance Affairs
        $this->form_validation->set_rules('company-finance-name', 'Finance Name', 'required|trim');
        $this->form_validation->set_rules('finance-position-company', 'Finance Position', 'required|trim');
        $this->form_validation->set_rules('phone-finance-company', 'Finance Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('email-finance-company', 'Finance Email', 'required|trim|is_unique[company_finance.email]');

        // Form Validation Info Engineering Affairs
        $this->form_validation->set_rules('company-engineering-name', 'Engineering Name', 'required|trim');
        $this->form_validation->set_rules('engineering-position-company', 'Engineering Position', 'required|trim');
        $this->form_validation->set_rules('phone-engineering-company', 'Engineering Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('email-engineering-company', 'Engineering Email', 'required|trim|is_unique[company_engineering.email]');

        // Form Validation Info General Affairs
        $this->form_validation->set_rules('company-general-name', 'General Name', 'required|trim');
        $this->form_validation->set_rules('general-position-company', 'General Position', 'required|trim');
        $this->form_validation->set_rules('phone-general-company', 'General Phone Number', 'required|trim');
        $this->form_validation->set_rules('email-general-company', 'General Email', 'required|trim|is_unique[company_general.email]');

        // Form Validation Info Technical Specification
        $this->form_validation->set_rules('captive-power', 'Captive Power', 'required|trim|max_length[2]');
        $this->form_validation->set_rules('amount-of-power', 'Amount of Power', 'required|trim');
        $this->form_validation->set_rules('next-meeting', 'Next Meeting', 'required|trim');
        $this->form_validation->set_rules('suggestion', 'Suggestion', 'required|trim|min_length[10]', [
            'min_length' => 'Suggestion at least 10 Characters'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Problem Mapping';
            $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
            $data['dropDown'] = $this->M_Admin->getService();
            $data['notif'] = get_new_notif();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('user/problem-mapping', $data);
            $this->load->view('templates/footer');
        } else {
            $status = $this->M_Admin->uploadProblemMapping();
            if ($status) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been added!</div>');
                redirect('user/problemMapping');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed to save data!</div>');
                redirect('user/problemMapping');
            }
        }
    }

    // public function uploadProblemMapping()
    // {
    //     $status = $this->M_Admin->problemMapping();
    //     if ($status) {
    //         $this->monitoring();
    //     } else {
    //         $this->problemMapping();
    //     }
    // }
}
