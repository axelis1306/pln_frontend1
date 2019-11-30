<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AccountExecutive extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Data Potential Customer';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        // $data['customers'] = $this->M_AccountExecutive->getCustomer();
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('account_executive/index', $data);
        $this->load->view('templates/footer');
    }

    public function getMonitoringList()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_AccountExecutive->getCustomer();
        $data = array();
        $no = $start;
        foreach ($list as $at) {
            $no++;
            $data[] = [
                'no' => $no,
                'name_customer' => $at['name_customer'],
                'id_customer' => $at['id_customer'],
                'tariff/daya' => $at['tariff'] . ' / ' . $at['power'],
                'type_of_service' => '<span class="badge ' . $at['badge'] . '">' . $at['type_of_service'] . '</span>',
                'status' => $at['status'],
                'information' => $at['information'],
                'btn1/btn2' => '<a id="btnProbing" name="btnProbing" href="' . $url . 'accountexecutive/btnproblemmapping/' . $at['id_customer'] . '" class="badge badge-primary badge-probing">Action</a>'
            ];                                                                          //INI SEHARUSNYA btnProblemMapping
        }

        $output = array(
            "draw" => $draw,
            "recordsTotal" => count($list),
            "recordsFiltered" => count($list),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function btnProblemMapping($id_customer)
    {
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $status = $data['customer']['status'];
        $information = $data['customer']['information'];
        // print_r($status);

        switch ($information) {
            case 'Not Yet':
                redirect('accountexecutive/problemMapping/' . $id_customer);
                break;

            case 'Probing':
                redirect('accountexecutive/kunjungan/' . $id_customer);
                break;

            case 'Menunggu Reksis':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive/index');
                break;

            case 'Proses Reksis':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive/index');
                break;

            case 'Proses SPJBTL':
                redirect('accountexecutive/addSPJBTL/' . $id_customer);
                break;

            case 'WO to Construction':
                redirect('accountexecutive/addWorkingOrder/' . $id_customer);
                break;

            case 'Working Order Terbit':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive');
                break;

            case 'On Construction':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive');
                break;

            case 'Waiting For Confirmation':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Waiting For Confirmation Manager</div>');
                redirect('accountexecutive');
                break;

            case 'Proses Energizing':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive');
                break;

            case 'Finished':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Customer has been Energized!</div>');
                redirect('accountexecutive');
                break;

            case 'Cancelled':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive');
                break;

            case 'Terminated By Problem':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('accountexecutive');
                break;

            default:
                redirect('auth/blocked');
                break;
        }
    }

    public function kunjungan($id_customer)
    {

        // print_r($data['customer']['name_customer']);
        // print_r($data['user']);
        $this->form_validation->set_rules('report_reason', 'Report Reason', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Kunjungan';
            $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
            $data['customer'] = $this->M_Report->getCustomerById($id_customer);
            $data['notif'] = get_new_notif();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('account_executive/report', $data);
            $this->load->view('templates/footer');
        } else {
            $this->uploadReport();
        }
    }

    public function uploadReport()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
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
                // $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                $this->session->set_flashdata('message', '<div class="alert alert-danger">', '</div>');
            } else {
                $ReportData = [
                    'id_user' => $userId,
                    'id_customer' => $custId,
                    'report_reason' => $reason,
                    'report_time' => $reportFolder
                ];

                $this->M_Report->addUserReport($ReportData);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Report has been Saved!</div>');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Report has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('accountexecutive/kunjungan/' . $custId);
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

    public function cancellationReport($id_customer)
    {

        // print_r($data['customer']['name_customer']);
        // print_r($data['user']);
        $this->form_validation->set_rules('report_reason', 'Report Reason', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Cancellation Report';
            $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
            $data['customer'] = $this->M_Report->getCustomerById($id_customer);
            $data['notif'] = get_new_notif();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('account_executive/cancellation_report', $data);
            $this->load->view('templates/footer');
        } else {
            $this->uploadCancellationReport();
        }
    }

    public function uploadCancellationReport()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $reason = $this->input->post('report_reason');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];
        $name_user = $this->session->userdata('name');

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['cancelImage']['name'][0])) {

            if ($this->upload_files_cancellation($reportFolder, $userId, $custName, $_FILES['cancelImage']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                // $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                $this->session->set_flashdata('message', '<div class="alert alert-danger">', '</div>');
            } else {
                $ReportData = [
                    'id_user' => $userId,
                    'id_customer' => $custId,
                    'cancellation_reason' => $reason,
                    'created_at' => $reportFolder
                ];

                $this->M_Report->addCancellationReport($ReportData);
                $updateData = array(
                    'id_information' => 12,
                );
                $this->db->where('id_customer', $custId);
                $this->db->update('customer', $updateData);

                // Kirim Notif Ke Manager
                $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 5, 'Penolakan', "Pelanggan {$custName} menolak untuk menjadi pelanggan premium PLN, Laporan Pembatalan sudah diupload {$name_user}. Segera lakukan Konfirmasi!", '');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Report has been Saved! Wait for confirmation</div>');
                redirect('accountexecutive');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Report has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            redirect('accountexecutive/cancellationReport/' . $custId);
        }


        // if (!isset($data['error'])) {
        //     // echo $data['error'];
        // }
        // // echo $reportFolder;
        // // print_r($custName);


    }
    private function upload_files_cancellation($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $cancellationFolder = 'Cancellation Folder/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $cancellationFolder)) {
            mkdir($structure . $custName . '/' . $cancellationFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $cancellationFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $cancelImage = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['cancelImage[]']['name'] = $files['name'][$key];
            $_FILES['cancelImage[]']['type'] = $files['type'][$key];
            $_FILES['cancelImage[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['cancelImage[]']['error'] = $files['error'][$key];
            $_FILES['cancelImage[]']['size'] = $files['size'][$key];

            $fileName = 'cancellation(' . $count . ')';
            $count = $count + 1;
            $cancelImage[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('cancelImage[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $cancelImage;
    }

    public function problemMappingBy()
    {
        $this->session->set_flashdata('message', '<div class="alert alert-warning" role="alert">
        Select the customer first whose status is <b>Not yet</b> or <b>Problem Mapping</b>, then press the Action Button</div>');
        redirect('accountexecutive');
    }

    public function problemMapping($id_customer)
    {
        // Form Validation Customers Profile
        $this->form_validation->set_rules('customer', 'Customer', 'required|trim');
        $this->form_validation->set_rules('address-customer', 'Address Customer', 'required|trim|min_length[20]', [
            'min_length' => 'Address at least 10 characters long'
        ]);
        $this->form_validation->set_rules('tariff', 'Tarif', 'required|trim|max_length[3]', [
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
        $this->form_validation->set_rules('email-leader-company', 'Leader Email', 'required|trim|valid_email');

        // Form Validation Info Finance Affairs
        $this->form_validation->set_rules('company-finance-name', 'Finance Name', 'required|trim');
        $this->form_validation->set_rules('finance-position-company', 'Finance Position', 'required|trim');
        $this->form_validation->set_rules('phone-finance-company', 'Finance Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('email-finance-company', 'Finance Email', 'required|trim');

        // Form Validation Info Engineering Affairs
        $this->form_validation->set_rules('company-engineering-name', 'Engineering Name', 'required|trim');
        $this->form_validation->set_rules('engineering-position-company', 'Engineering Position', 'required|trim');
        $this->form_validation->set_rules('phone-engineering-company', 'Engineering Phone Number', 'required|trim|numeric');
        $this->form_validation->set_rules('email-engineering-company', 'Engineering Email', 'required|trim');

        // Form Validation Info General Affairs
        $this->form_validation->set_rules('company-general-name', 'General Name', 'required|trim');
        $this->form_validation->set_rules('general-position-company', 'General Position', 'required|trim');
        $this->form_validation->set_rules('phone-general-company', 'General Phone Number', 'required|trim');
        $this->form_validation->set_rules('email-general-company', 'General Email', 'required|trim');

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
            $data['dropDown'] = $this->M_AccountExecutive->getService();
            $data['customer'] = $this->M_AccountExecutive->getCustomerById($id_customer);
            $data['tariff'] = $this->M_AccountExecutive->getTariff();
            $data['notif'] = get_new_notif();

            // print_r($data['user']);

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('account_executive/problem-mapping', $data);
            $this->load->view('templates/footer');
        } else {
            $status = $this->uploadProblemMapping($id_customer);
            $data['customer'] = $this->M_AccountExecutive->getCustomerById($id_customer);
            $customer = $data['customer'];
            $name_user = $this->session->userdata('name');
            if ($status) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been added!</div>');
                $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 12, 'Info', "{$customer['name_customer']} telah dikunjungi oleh {$name_user} dan telah melakukan peremajaan data", '');
                redirect('accountexecutive');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed to save data!</div>');
                redirect('accountexecutive');
            }
        }
    }

    public function uploadProblemMapping($id_customer)
    {
        $name_customer = $this->input->post('customer');
        $address_customer = $this->input->post('address-customer');
        $tarif = $this->input->post('tariff');
        $daya = $this->input->post('power');
        $dropDown = $this->input->post('dropDown');
        $captive_power = $this->input->post('captive-power');
        $amount_of_power = $this->input->post('amount-of-power');
        $next_meeting = $this->input->post('next-meeting');
        $suggestion = $this->input->post('suggestion');

        $company_name = $this->input->post('company-name');
        $address_company = $this->input->post('address-company');
        $phone_company = $this->input->post('phone-company');
        $facsimile = $this->input->post('facsimile');
        $email_company = $this->input->post('email-company');
        $establishment = $this->input->post('establishment');

        $company_leader_name = $this->input->post('company-leader-name');
        $leader_position_company = $this->input->post('leader-position-company');
        $phone_leader_company = $this->input->post('phone-leader-company');
        $email_leader_company = $this->input->post('email-leader-company');

        $company_finance_name = $this->input->post('company-finance-name');
        $finance_position_company = $this->input->post('finance-position-company');
        $phone_finance_company = $this->input->post('phone-finance-company');
        $email_finance_company = $this->input->post('email-finance-company');

        $company_engineering_name = $this->input->post('company-engineering-name');
        $engineering_position_company = $this->input->post('engineering-position-company');
        $phone_engineering_company = $this->input->post('phone-engineering-company');
        $email_engineering_company = $this->input->post('email-engineering-company');

        $company_general_name = $this->input->post('company-general-name');
        $general_position_company = $this->input->post('general-position-company');
        $phone_general_company = $this->input->post('phone-general-company');
        $email_general_company = $this->input->post('email-general-company');

        $company_profile = [
            'name_company' => $company_name,
            'address_company' => $address_company,
            'phone' => $phone_company,
            'facsimile' => $facsimile,
            'email_company' => $email_company,
            'date_of_establishment' => $establishment
        ];

        $company_leader = [
            'name_company_leader' => $company_leader_name,
            'position' => $leader_position_company,
            'phone' => $phone_leader_company,
            'email' => $email_leader_company,
        ];

        $company_finance = [
            'name_company_finance' => $company_finance_name,
            'position' => $finance_position_company,
            'phone' => $phone_finance_company,
            'email' => $email_finance_company
        ];

        $company_engineering = [
            'name_company_engineering' => $company_engineering_name,
            'position' => $engineering_position_company,
            'phone' => $phone_engineering_company,
            'email' => $email_engineering_company
        ];

        $company_general = [
            'name_company_general' => $company_general_name,
            'position' => $general_position_company,
            'phone' => $phone_general_company,
            'email' => $email_general_company
        ];

        // Insert Data Company Profile
        $this->db->insert('company_profile', $company_profile);
        $id_company_profile = $this->db->insert_id();

        //Insert Data Company Leader
        $this->db->insert('company_leader', $company_leader);
        $id_company_leader = $this->db->insert_id();

        // Insert Data Company Finance
        $this->db->insert('company_finance', $company_finance);
        $id_company_finance = $this->db->insert_id();

        // Insert Data Company Engineering
        $this->db->insert('company_engineering', $company_engineering);
        $id_company_engineering = $this->db->insert_id();

        // Insert Data Company General Affairs
        $this->db->insert('company_general', $company_general);
        $id_company_general = $this->db->insert_id();


        $data = [
            'id_company_profile' => $id_company_profile,
            'id_company_leader' => $id_company_leader,
            'id_company_finance' => $id_company_finance,
            'id_company_engineering' => $id_company_engineering,
            'id_company_general' => $id_company_general,
            'name_customer' => $name_customer,
            'address_customer' => $address_customer,
            'id_tariff' => $tarif,
            'power' => $daya,
            'id_type_of_service' => $dropDown,
            'id_status' => 2,
            'id_information' => 2,
            'captive_power' => $captive_power,
            'amount_of_power' => $amount_of_power,
            'next_meeting' => $next_meeting,
            'suggestion' => $suggestion
        ];


        $this->db->where('id_customer', $id_customer);
        return ($this->db->update('customer', $data) != 1) ? false : true;
    }

    public function closing($id_customer)
    {
        $this->form_validation->set_rules('id_karyawan', 'ID USER', 'required');
        $this->form_validation->set_rules('id_customer', 'ID CUSTOMER', 'required');
        if (empty($_FILES['uploadAppLetter']['name'])) {
            $this->form_validation->set_rules('uploadAppLetter', 'Files', 'required');
        }

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Closing';
            $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
            $data['customer'] = $this->M_Report->getCustomerById($id_customer);
            $data['notif'] = get_new_notif();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('account_executive/closing', $data);
            $this->load->view('templates/footer');
        } else {
            $this->uploadClosing();
        }
    }


    public function uploadClosing()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];
        $statusCust = $customer['customer']['status'];
        $name_user = $this->session->userdata('name');

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['appLetter']['name'][0])) {

            if ($this->upload_files_closing($reportFolder, $userId, $custName, $_FILES['appLetter']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $appLetter = [
                'id_user' => $userId,
                'id_customer' => $custId,
                'id_user_app_letter' => $userId,
                'app_letter' => $reportFolder,
            ];

            $this->M_AccountExecutive->addUserClosing($appLetter);
            $updateData = array(
                'id_information' => 3,
                'id_status' => 3
            );
            $this->db->where('id_customer', $custId);
            $this->db->update('customer', $updateData);

            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 12, 'Info', "{$custName} telah memasuki tahap Closing. Surat Permohonan Pelanggan sudah di upload oleh {$name_user}", '');
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 13, 'Report', "{$custName} telah memasuki tahap Closing. Surat Permohonan Pelanggan sudah di upload oleh {$name_user}. Terbitkan Rekomendasi Sistem dan SLD segera!", '');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Application Letter has been uploaded!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Upload has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('accountexecutive/index');
    }

    private function upload_files_closing($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $appLetterFolder = 'appLetter/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $appLetterFolder)) {
            mkdir($structure . $custName . '/' . $appLetterFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $appLetterFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $appLetter = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['appLetter[]']['name'] = $files['name'][$key];
            $_FILES['appLetter[]']['type'] = $files['type'][$key];
            $_FILES['appLetter[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['appLetter[]']['error'] = $files['error'][$key];
            $_FILES['appLetter[]']['size'] = $files['size'][$key];

            $fileName = 'appLetter(' . $count . ')';
            $count = $count + 1;
            $appLetter[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('appLetter[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $appLetter;
    }

    public function addSPJBTL($id_customer)
    {
        $data['title'] = 'Upload SPJBTL';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('account_executive/upload_spjbtl', $data);
        $this->load->view('templates/footer');
    }

    public function uploadSPJBTL()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $reason = $this->input->post('report_reason');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];
        $name_user = $this->session->userdata('name');

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['spjbtl']['name'][0]) && !empty($_FILES['contract']['name'][0])) {

            if ($this->upload_spjbtl($reportFolder, $userId, $custName, $_FILES['spjbtl']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            if ($this->upload_contract($reportFolder, $userId, $custName, $_FILES['contract']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $dataSPJBTL = [
                'id_user_spjbtl' => $userId,
                'spjbtl' => $reportFolder,
                'id_user_contract_letter' => $userId,
                'contract_letter' => $reportFolder,
            ];

            $ReportData = [
                'id_user' => $userId,
                'id_customer' => $custId,
                'report_reason' => $reason,
                'report_time' => $reportFolder
            ];

            // Masukin Report
            $this->M_Report->addUserReport($ReportData);

            // Masukin Reksis SLD ke table User Closing
            $this->db->set($dataSPJBTL);
            $this->db->where('id_customer', $custId);
            $this->db->update('user_closing');

            // Update Informasi
            $this->db->set('id_information', 6);
            $this->db->where('id_customer', $custId);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 12, 'Info', "SPJBTL dan Surat Kontrak Pelanggan {$custName} telah di upload oleh {$name_user}.", '');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    SPJBTL and Contract Leter has been Uploaded!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Upload file has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('accountexecutive/index');
    }

    private function upload_spjbtl($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure_report = "assets/report/";
        $structure = "assets/berkas/";
        $spjbtlFolder = 'SPJBTL/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $spjbtlFolder)) {
            mkdir($structure . $custName . '/' . $spjbtlFolder, 0777);
        }

        $reportDirectoryNameReport = $structure_report . '/' . $custName . '/' . $date[0] . '-' . $date[1] . '-' . $date[2] . ' ' . $time[0] . '-' . $time[1];
        mkdir($reportDirectoryNameReport, 0777);

        $reportDirectoryName = $structure . '/' . $custName . '/' . $spjbtlFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $spjbtl = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['spjbtl[]']['name'] = $files['name'][$key];
            $_FILES['spjbtl[]']['type'] = $files['type'][$key];
            $_FILES['spjbtl[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['spjbtl[]']['error'] = $files['error'][$key];
            $_FILES['spjbtl[]']['size'] = $files['size'][$key];

            $fileName = 'spjbtl(' . $count . ')';
            $count = $count + 1;
            $spjbtl[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('spjbtl[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $spjbtl;
    }

    private function upload_contract($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $contractFolder = 'Contract Letter/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $contractFolder)) {
            mkdir($structure . $custName . '/' . $contractFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $contractFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $contract = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['contract[]']['name'] = $files['name'][$key];
            $_FILES['contract[]']['type'] = $files['type'][$key];
            $_FILES['contract[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['contract[]']['error'] = $files['error'][$key];
            $_FILES['contract[]']['size'] = $files['size'][$key];

            $fileName = 'contractLetter(' . $count . ')';
            $count = $count + 1;
            $contract[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('contract[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $contract;
    }

    public function addWorkingOrder($id_customer)
    {
        $data['title'] = 'Upload Working Order';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('account_executive/upload_WO', $data);
        $this->load->view('templates/footer');
    }

    public function uploadWorkingOrder()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];
        $statusCust = $customer['customer']['status'];
        $name_user = $this->session->userdata('name');

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['working_order']['name'][0])) {

            if ($this->upload_working_order($reportFolder, $userId, $custName, $_FILES['working_order']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $updateInfo = [
                'id_information' => 7,
                'id_status' => 4
            ];

            $dataClosing = [
                'id_user_wo_cons' => $userId,
                'working_order_cons' => $reportFolder
            ];

            // Masukin Reksis SLD ke table User Closing
            $this->db->set($dataClosing);
            $this->db->where('id_customer', $custId);
            $this->db->update('user_closing');

            // Update Informasi
            $this->db->set($updateInfo);
            $this->db->where('id_customer', $custId);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 12, 'Info', "Working Order pelaksanaan konstruksi Pelanggan {$custName} untuk bagian Konstruksi telah Terbit, di upload oleh {$name_user}.", '');
            // Kirim Notif ke Construction
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 15, 'Need Action', "Working Order pelaksanaan konstruksi Pelanggan {$custName} telah terbit, di upload oleh {$name_user} bagian Planning. Lakukan Pelaksanaan Konstruksi Segera! Semangat!", '');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Working Order has been uploaded!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Upload has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('accountexecutive/index');
    }

    private function upload_working_order($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $workingOrderFolder = 'Working Order/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $workingOrderFolder)) {
            mkdir($structure . $custName . '/' . $workingOrderFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $workingOrderFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $images = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['working_order[]']['name'] = $files['name'][$key];
            $_FILES['working_order[]']['type'] = $files['type'][$key];
            $_FILES['working_order[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['working_order[]']['error'] = $files['error'][$key];
            $_FILES['working_order[]']['size'] = $files['size'][$key];

            $fileName = 'workingOrder(' . $count . ')';
            $count = $count + 1;
            $workingOrder[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('working_order[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $workingOrder;
    }
}
