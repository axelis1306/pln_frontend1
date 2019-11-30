<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Construction extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Master Data Pelanggan Premium';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customers'] = $this->M_Construction->getCustomer();
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('construction/index', $data);
        $this->load->view('templates/footer');
    }
    public function getMonitoringList()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_Construction->getCustomer();
        $data = array();
        $no = $start;
        foreach ($list as $at) {
            $no++;
            if ($at['information'] != 'Working Order Terbit' && $at['information'] != 'On Construction' && $at['information'] != 'Proses Energizing' && $at['information'] != 'Finished' && $at['information'] != 'Waiting For Confirmation') {
                continue;
            }
            $data[] = [
                'no' => $no,
                'name_customer' => $at['name_customer'],
                'id_customer' => $at['id_customer'],
                'tariff/daya' => $at['tariff'] . ' / ' . $at['power'],
                'type_of_service' => '<span class="badge ' . $at['badge'] . '">' . $at['type_of_service'] . '</span>',
                'status' => $at['status'],
                'information' => $at['information'],
                'btn1/btn2' => '<a id="btnProbing" name="btnProbing" href="' . $url . 'construction/btnAction/' . $at['id_customer'] . '" class="badge badge-primary badge-probing">Action</a>'
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

    public function btnAction($id_customer)
    {
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $status = $data['customer']['status'];
        $information = $data['customer']['information'];
        // print_r($status);

        switch ($information) {
            case 'Not Yet':
                redirect('construction/problemMapping');
                break;

            case 'Probing':
                redirect('construction/kunjungan/' . $id_customer);
                break;

            case 'Menunggu Reksis':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('construction/index');
                break;

            case 'Proses Reksis':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('construction/index');
                break;

            case 'Proses SPJBTL':
                redirect('construction/addSPJBTL/' . $id_customer);
                break;

            case 'Working Order Terbit':
                redirect('construction/detailCustomer/' . $id_customer);
                break;

            case 'On Construction':
                redirect('construction/reportConstruction/' . $id_customer);
                break;

            case 'Waiting For Confirmation':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('construction');
                break;

            case 'Proses Energizing':
                redirect('construction/energize/' . $id_customer);
                break;

            case 'Finished':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Customer has been Energized!</div>');
                redirect('construction');
                break;

            case 'Cancelled':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('construction');
                break;

            default:
                redirect('auth/blocked');
                break;
        }
    }

    public function detailCustomer($id_customer)
    {
        $data['title'] = 'Detail Report';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['report'] = $this->M_Report->getReportByIdCustomer($id_customer);
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['user_closing'] = $this->M_Construction->getInfoClosing($id_customer);
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
        $this->load->view('construction/detailCustomer', $data);
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

    public function reportConstruction($id_customer)
    {
        $data['title'] = 'Upload Report Construction';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Construction->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();
        $data['user_closing'] = $this->M_Planning->getInfoClosing($id_customer);
        $custName = $data['customer']['name_customer'];
        $name_user = $this->session->userdata('name');
        $userIdAe = $data['user_closing']['id_user'];

        $customer = $data['customer'];

        if ($customer['id_information'] != 8) {
            $this->db->set('id_information', 8);
            $this->db->where('id_customer', $id_customer);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 8, 'On Construction', "Pelanggan {$custName} telah memasuki proses Konstruksi.", '');
            // Kirim Notif ke Account Executive
            $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 9, 'Info', "Pelanggan {$custName} telah memasuki proses Konstruksi.", $userIdAe);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('construction/report', $data);
        $this->load->view('templates/footer');
    }

    public function uploadReportConstruction()
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
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Report has been Saved!</div>');
        redirect('construction/reportConstruction/' . $custId);
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
            $this->load->view('construction/cancellationReport', $data);
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
                $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 17, 'Terjadi Kendala', "Terdapat Kendala dalam Pengerjaan Konstruksi Pelanggan {$custName}, Laporan Pembatalan Karena kendala pada konstruksi sudah diupload {$name_user} Bagian Construction. Segera lakukan Konfirmasi!", '');
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                        Cancellation Report has been Saved! Wait for confirmation</div>');
                redirect('construction');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Cancellation Report has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
            redirect('construction/cancellationReport/' . $custId);
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
            'max_size' => "6144"
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

    public function energize($id_customer)
    {
        $data['title'] = 'Upload Berkas Energizing';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Construction->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();
        $data['user_closing'] = $this->M_Construction->getInfoClosing($id_customer);
        $customer = $data['customer'];
        $custName = $customer['name_customer'];
        $name_user = $this->session->userdata('name');
        $userIdAe = $data['user_closing']['id_user'];

        if ($customer['id_information'] != 9) {
            $status = [
                'id_status' => 5,
                'id_information' => 9
            ];
            $this->db->set($status);
            $this->db->where('id_customer', $id_customer);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 4, 'Proses Energize', "Pelanggan {$custName} telah memasuki proses Energizing. Bersiaplah!", '');
            // Kirim Notif ke Account Executive
            $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 10, 'Proses Energize', "Pelanggan {$custName} telah memasuki proses Konstruksi. Bersiaplah!", $userIdAe);
        }

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('construction/reportEnergize', $data);
        $this->load->view('templates/footer');
    }

    public function uploadEnergize()
    {
        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $catatan_khusus = $this->input->post('catatan_khusus');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $data['user_closing'] = $this->M_Planning->getInfoClosing($custId);
        $custName = $customer['customer']['name_customer'];
        $name_user = $this->session->userdata('name');
        $userIdAe = $data['user_closing']['id_user'];

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['ba_aco']['name'][0]) && !empty($_FILES['ba_penyambungan']['name'][0]) && !empty($_FILES['surat_pk']['name'][0]) && !empty($_FILES['dokumentasi']['name'][0])) {

            if ($this->upload_ba_aco($reportFolder, $userId, $custName, $_FILES['ba_aco']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            if ($this->upload_ba_penyambungan($reportFolder, $userId, $custName, $_FILES['ba_penyambungan']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            if ($this->upload_surat_pk($reportFolder, $userId, $custName, $_FILES['surat_pk']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            if ($this->upload_dokumentasi($reportFolder, $userId, $custName, $_FILES['dokumentasi']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $energized = [
                'id_user' => $userId,
                'id_customer' => $custId,
                'catatan_khusus' => $catatan_khusus,
                'ba_aco' => $reportFolder,
                'ba_penyambungan' => $reportFolder,
                'surat_pk' => $reportFolder,
                'dokumentasi' => $reportFolder,

            ];
            // Insert Data ENERGIZING  ke table User Energize
            $this->db->insert('user_energize', $energized);

            // Update informasi
            $informasi = [
                'id_status' => 6,
                'id_information' => 10
            ];
            $this->db->set($informasi);
            $this->db->where('id_customer', $custId);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 16, "{$custName} Energized!", "{$custName} telah berhasil di Energized! Pelanggan kini resmi menjadi Pelanggan Premium, Selamat!!", '');
            // Kirim Notif ke Construction
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 6, "{$custName} Energized!", "{$custName} telah berhasil di Energized! Pelanggan kini resmi menjadi Pelanggan Premium, Selamat!!", $userIdAe);

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Customer has been Energized!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Report has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('construction/index/');
    }

    private function upload_ba_aco($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $reksisSLDFolder = 'BA ACO/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $reksisSLDFolder)) {
            mkdir($structure . $custName . '/' . $reksisSLDFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $reksisSLDFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $ba_aco = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['ba_aco[]']['name'] = $files['name'][$key];
            $_FILES['ba_aco[]']['type'] = $files['type'][$key];
            $_FILES['ba_aco[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['ba_aco[]']['error'] = $files['error'][$key];
            $_FILES['ba_aco[]']['size'] = $files['size'][$key];

            $fileName = 'ba_aco(' . $count . ')';
            $count = $count + 1;
            $ba_aco[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ba_aco[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $ba_aco;
    }
    private function upload_ba_penyambungan($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $reksisSLDFolder = 'BA Penyambungan/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $reksisSLDFolder)) {
            mkdir($structure . $custName . '/' . $reksisSLDFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $reksisSLDFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $ba_penyambungan = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['ba_penyambungan[]']['name'] = $files['name'][$key];
            $_FILES['ba_penyambungan[]']['type'] = $files['type'][$key];
            $_FILES['ba_penyambungan[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['ba_penyambungan[]']['error'] = $files['error'][$key];
            $_FILES['ba_penyambungan[]']['size'] = $files['size'][$key];

            $fileName = 'ba_penyambungan(' . $count . ')';
            $count = $count + 1;
            $ba_penyambungan[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('ba_penyambungan[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $ba_penyambungan;
    }
    private function upload_surat_pk($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $reksisSLDFolder = 'Surat Perintah Kerja/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $reksisSLDFolder)) {
            mkdir($structure . $custName . '/' . $reksisSLDFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $reksisSLDFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $surat_pk = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['surat_pk[]']['name'] = $files['name'][$key];
            $_FILES['surat_pk[]']['type'] = $files['type'][$key];
            $_FILES['surat_pk[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['surat_pk[]']['error'] = $files['error'][$key];
            $_FILES['surat_pk[]']['size'] = $files['size'][$key];

            $fileName = 'surat_pk(' . $count . ')';
            $count = $count + 1;
            $surat_pk[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('surat_pk[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $surat_pk;
    }
    private function upload_dokumentasi($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $reksisSLDFolder = 'Dokumentasi Energize/';

        if (!file_exists($structure)) {
            mkdir($structure, 0777);
        }
        if (!file_exists($structure . $custName)) {
            mkdir($structure . $custName, 0777);
        }

        if (!file_exists($structure . $custName . '/' . $reksisSLDFolder)) {
            mkdir($structure . $custName . '/' . $reksisSLDFolder, 0777);
        }

        $reportDirectoryName = $structure . '/' . $custName . '/' . $reksisSLDFolder;
        $config = array(
            'upload_path'   => $reportDirectoryName,
            'allowed_types' => 'jpg|gif|png|jpeg|pdf',
            'overwrite'     => 1,
        );

        $this->load->library('upload', $config);

        $dokumentasi = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['dokumentasi[]']['name'] = $files['name'][$key];
            $_FILES['dokumentasi[]']['type'] = $files['type'][$key];
            $_FILES['dokumentasi[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['dokumentasi[]']['error'] = $files['error'][$key];
            $_FILES['dokumentasi[]']['size'] = $files['size'][$key];

            $fileName = 'energize(' . $count . ')';
            $count = $count + 1;
            $dokumentasi[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('dokumentasi[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $dokumentasi;
    }
}
