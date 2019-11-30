<?php
defined('BASEPATH') or exit('No direct script access allowed');
// LOAD AUTOLOAD DARI FOLDER VENDOR (LIBRARY)
require 'vendor/Phpoffice/vendor/autoload.php';
class Planning extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {

        $data['title'] = 'Master Data Potential Customer';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customers'] = $this->M_Planning->getCustomer();
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('planning/index', $data);
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
                'type_of_service' => '<span class="badge ' . $at['badge'] . '">' . $at['type_of_service'] . '</span>',
                'status' => $at['status'],
                'btn' => '<a href="' . $url . 'planning/detailCustomer/' . $at['id_customer'] . '" class="badge badge-primary">Detail</a>'
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
        $data['title'] = 'Detail Customer';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('planning/detail_customer', $data);
        $this->load->view('templates/footer');
    }


    public function dataForReksis()
    {

        $data['title'] = 'Master Data Potential Customer';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customers'] = $this->M_Planning->getCustomer();
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('planning/data_for_reksis', $data);
        $this->load->view('templates/footer');
    }

    public function getDataForReksis()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_Planning->getCustomer();
        $data = array();
        $no = $start;
        foreach ($list as $at) {
            $no++;
            if ($at['information'] != 'Menunggu Reksis' && $at['information'] != 'Proses Reksis') {
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
                'btn1/btn2' => '<a id="btnProbing" name="btnProbing" href="' . $url . 'planning/btnproblemmapping/' . $at['id_customer'] . '" class="badge badge-primary badge-probing">Action</a>'
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
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Probing':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Menunggu Reksis':
                $this->db->set('id_information', 4);
                $this->db->where('id_customer', $id_customer);
                $this->db->update('customer');
                redirect('planning/addReksis/' . $id_customer);
                break;

            case 'Proses Reksis':
                redirect('planning/addReksis/' . $id_customer);
                break;

            case 'Proses SPJBTL':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'WO to Construction':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'On Construction':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Waiting For Confirmation':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Proses Energizing':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Finished':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            case 'Cancelled':
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Can\'t Access This Customer</div>');
                redirect('planning/index');
                break;

            default:
                redirect('auth/blocked');
                break;
        }
    }

    public function addPotencial()
    {
        $data['title'] = 'Input Potencial';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customers'] = $this->M_Planning->getCustomer();
        $data['service'] = $this->M_Planning->getService();
        $data['substation'] = $this->M_Planning->getSubstation();
        $data['feeder_substation'] = $this->M_Planning->getFeederSubstation();
        $data['tariff'] = $this->M_Planning->getTariff();
        $data['notif'] = get_new_notif();

        $this->form_validation->set_rules('cust-name', 'Customer Name', 'required|trim');
        $this->form_validation->set_rules('cust-id', 'ID Customer', 'required|trim|max_length[9]');
        $this->form_validation->set_rules('power', 'Daya', 'required|trim|numeric', [
            'numeric' => 'Numbers Only'
        ]);
        $this->form_validation->set_rules('tariff', 'Tarif', 'required|trim|max_length[2]', [
            'max_length' => '3 Characters Only'
        ]);
        $this->form_validation->set_rules('cust-address', 'Customer Address', 'required|trim|min_length[10]');
        $this->form_validation->set_rules('substation', 'Substation', 'required|trim');
        $this->form_validation->set_rules('feeder-substation', 'Feeder Substation', 'required|trim');
        $this->form_validation->set_rules('subsistem', 'Subsistem', 'required|trim');
        $this->form_validation->set_rules('bep-value', 'BEP Value', 'required|trim');
        $this->form_validation->set_rules('recommend-service', 'Service', 'required|trim');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('planning/input_potensial', $data);
            $this->load->view('templates/footer');
        } else {
            $cust_name = $this->input->post('cust-name');
            $cust_id = $this->input->post('cust-id');
            $tariff = $this->input->post('tariff');
            $power = $this->input->post('power');
            $cust_address = $this->input->post('cust-address');
            $id_substation = $this->input->post('substation');
            $id_feeder_substation = $this->input->post('feeder-substation');
            $subsistem = $this->input->post('subsistem');
            $bep_value = $this->input->post('bep-value');
            $recommend_service = $this->input->post('recommend-service');
            $data = [
                'name_customer' => $cust_name,
                'id_customer' => $cust_id,
                'id_tariff' => $tariff,
                'power' => $power,
                'address_customer' => $cust_address,
                'id_substation' => $id_substation,
                'id_feeder_substation' => $id_feeder_substation,
                'subsistem' => $subsistem,
                'bep_value' => $bep_value,
                'id_type_of_service' => $recommend_service,
            ];
            $data2 = [
                'name_customer' => $cust_name,
                'id_tariff' => $tariff,
                'power' => $power,
                'address_customer' => $cust_address,
                'id_substation' => $id_substation,
                'id_feeder_substation' => $id_feeder_substation,
                'subsistem' => $subsistem,
                'bep_value' => $bep_value,
                'id_type_of_service' => $recommend_service,
                'id_status' => '1',
                'id_information' => 1
            ];

            $this->M_Planning->addPotencial($data);
            $this->M_Planning->addCustomer($data2);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been added!</div>');
            redirect('planning/addPotencial');
        }
    }

        public function ajax_add() //Fungsi Input Pake Excel
    {
        // NGAMBIL NAMA FILE YANG DI UPLOAD SAMA NGASIH STRING RANDOM
        $file_potential = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZqwertyuiopasdfghjklzxcvbnm'), 1, 8) . str_replace(' ', '_', $_FILES['file_excel']['name']);

        //KONFIGURASU UPLOAD
        $config['upload_path'] = realpath('./assets/docs/temp');
        $config['allowed_types'] = 'xlsx';

        $config['file_name'] = $file_potential;
        $this->upload->initialize($config);

        // CEK KALO UPLOAD ERROR
        if (!$this->upload->do_upload('file_excel')) {
            // echo json_encode(['status' => 'error']);
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                Failed to input data!</div>');
            redirect('planning/addPotencial');
            return;
        }

        //BIKIN OBJECT READER XLSX
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();

        //LOKASI FILE YANG UDAH DI UPLOAD
        $spreadsheet = $reader->load('./assets/docs/temp/' . $file_potential);
        $worksheet = $spreadsheet->getActiveSheet();

        $rows = [];
        // LOOPING DI SETIAP BARIS
        foreach ($worksheet->getRowIterator() as $row) {
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(false); // KALO DI FALSE, DIA BAKAL LOOP KE SEMUAL CELL. KALO DI TRUE CUMAN BAKAL LOOP DI CELL YANG ADA ISINYA
            $cells = [];
            //LOOP DI SETIAP KOLOM DI BARIS
            foreach ($cellIterator as $cell) {
                $cells[] = $cell->getValue();
            }

            //ARRAY NYA DI MASUKIN KE ARRAY JADI ENTAR HASILNYA ARRAY 2D
            $rows[] = $cells;
        }
        $tariff = $this->M_Planning->getTariff();
        $service = $this->M_Planning->getService();
        $substation = $this->M_Planning->getSubstation();
        $feeder_substation = $this->M_Planning->getFeederSubstation();

        // BIKIN ARRAY BARU BUAT MINDAH HASILNYA KALO PERLU
        $kor = [];
        $i = 0;
        foreach ($rows as $r) {
            //KALO PAKE HEADER skip pertama
            if ($i++ == 0) continue;

            $tarif = $this->M_Planning->getIdTariffByTariff($r[2]);
            $tarif = ($tarif[0]['id_tariff']);
            $substas = $this->M_Planning->getSubstationBySubstation($r[5]);
            $substas = ($substas[0]['id_substation']);
            $feeder = $this->M_Planning->getFeederSubstationByFeederSubstation($r[6]);
            $feeder = $feeder[0]['id_feeder_substation'];
            $service = $this->M_Planning->getServiceByService($r[9]);
            $service = $service[0]['id_type_of_service'];
            $kor[] = [
                'name_customer' => $r[0],
                'id_customer' => $r[1],
                'id_tariff' => $tarif,
                'power' => $r[3],
                'address_customer' => $r[4],
                'id_substation' => $substas,
                'id_feeder_substation' => $feeder,
                'subsistem' => $r[7],
                'bep_value' => $r[8],
                'id_type_of_service' => $service,
                'id_status' => 1,
                'id_information' => 1
            ];
        }
        //HAPUS FILE YANG UDAH DI UPLOAD TADI
        unlink(realpath('./assets/docs/temp//') . '\\' . $file_potential);
        // PAKE INI KALO MAU LIAT OUTPUT JSON NYA
        // print_r($kor);

        //PAKE INI KALO MAU INPUT KE DB SEKALIGUS
        $this->db->insert_batch('potencial_customer', $kor);
        $this->db->insert_batch('customer', $kor);

        // INI BUAT STATUS AJA
        // echo json_encode(array('status' => true));
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                Data has been added!</div>');
        redirect('planning/dataForReksis');
    }
	
    

    public function addReksis($id_customer)
    {
        $data['title'] = 'Upload Reksis dan SLD';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['notif'] = get_new_notif();
        $data['user_closing'] = $this->M_Planning->getInfoClosing($id_customer);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('planning/upload_reksis', $data);
        $this->load->view('templates/footer');
    }

    public function uploadReksis()
    {

        $userId = $this->input->post('id_karyawan');
        $custId = $this->input->post('id_customer');
        $userIdAe = $this->input->post('id_user_ae');
        $customer['customer'] = $this->M_Report->getCustomerById($custId);
        $custName = $customer['customer']['name_customer'];
        $name_user = $this->session->userdata('name');

        date_default_timezone_set('Asia/Jakarta');
        $reportFolder = date("Y-m-d H-i:s");

        $data = array();
        if (!empty($_FILES['reksisSLD']['name'][0])) {

            if ($this->upload_reksis_sld($reportFolder, $userId, $custName, $_FILES['reksisSLD']) === FALSE) {
                echo $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
                echo base_url() . "assets/img/";
                $data['error'] = $this->upload->display_errors('<div class="alert alert-danger">', '</div>');
            }
            $reksisSLD = [
                'id_customer' => $custId,
                'id_user_reksis_sld' => $userId,
                'reksis_sld' => $reportFolder,

            ];
            // Masukin Reksis SLD ke table User Closing
            $this->db->set('reksis_sld', $reportFolder);
            $this->db->where('id_customer', $custId);
            $this->db->update('user_closing');

            // Update informasi
            $this->db->set('id_information', 5);
            $this->db->where('id_customer', $custId);
            $this->db->update('customer');

            // Kirim Notif Ke Manager
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 12, 'Info', "Rekomendasi Sistem dan SLD untuk {$custName} telah terbit, di upload oleh {$name_user}.", '');
            // Kirim Notif ke Account Executive
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 2, 'Info', "Rekomendasi Sistem dan SLD untuk {$custName} telah terbit, di upload oleh {$name_user} bagian Planning.", $userIdAe);
            // Kirim Notif ke Construction
            $this->M_Notification->setNotification($custId, $this->session->userdata('id_user'), 14, 'Report', "Rekomendasi Sistem dan SLD untuk {$custName} telah terbit, di upload oleh {$name_user} bagian Planning.", '');
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
                    Reksis and SLD has been uploaded!</div>');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">
                    Report has been Failed!<button type="button" class="close" data-dismiss="alert">&times;</button></div>');
        }


        if (!isset($data['error'])) {
            // echo $data['error'];
        }
        // echo $reportFolder;
        // print_r($custName);

        redirect('planning/dataForReksis');
    }

    private function upload_reksis_sld($reportFolder, $userId, $custName, $files)
    {
        $reportFolder = (string) $reportFolder;
        $datetime = explode(' ', $reportFolder);
        $date = explode('-', $datetime[0]);
        $time = explode(':', $datetime[1]);
        $structure = "assets/berkas/";
        $reksisSLDFolder = 'Reksis+SLD/';

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

        $images = array();
        $count = 1;

        foreach ($files['name'] as $key => $image) {
            $_FILES['reksisSLD[]']['name'] = $files['name'][$key];
            $_FILES['reksisSLD[]']['type'] = $files['type'][$key];
            $_FILES['reksisSLD[]']['tmp_name'] = $files['tmp_name'][$key];
            $_FILES['reksisSLD[]']['error'] = $files['error'][$key];
            $_FILES['reksisSLD[]']['size'] = $files['size'][$key];

            $fileName = $count;
            $count = $count + 1;
            $reksisSLD[] = $fileName;
            $config['file_name'] = $fileName;
            $this->upload->initialize($config);

            if ($this->upload->do_upload('reksisSLD[]')) {
                $this->upload->data();
            } else {
                return false;
            }
        }
        return $reksisSLD;
    }
}
