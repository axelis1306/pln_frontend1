<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manager extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Monitoring';
        $data['customers'] = $this->M_Report->getCustomer();
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/monitoring', $data);
        $this->load->view('templates/footer');
    }

    public function getMonitoringList()
    {

        $draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        $url = base_url();
        $list = $this->M_Manager->getCustomer();
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
                'status' =>  $at['status'],
                'information' => $at['information'],
                'btn' => '<a id="btnProbing" name="btnProbing" href="' . $url . 'manager/btnAction/' . $at['id_customer'] . '" class="badge badge-primary badge-probing">Detail</a>'
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

    public function addConfirmCancel($id_customer)
    {
        $data['user_cancellation'] = $this->M_Report->getCancellationByIdCustomer($id_customer);
        $id_user_cancellation = $data['user_cancellation']['id_user'];
        $data['customer'] = $this->M_Manager->getCustomerById($id_customer);
        $custName = $data['customer']['name_customer'];
        $name_user = $this->session->userdata('name');


        $update = [
            'id_information' => 11,
            'id_status' => 7
        ];
        $this->db->set($update);
        $this->db->where('id_customer', $id_customer);
        $this->db->update('customer');

        $this->M_Notification->setNotification($id_customer, $this->session->userdata('id_user'), 11, 'Sudah Di Konfirmasi', "Pembatalan Pelanggan {$custName} telah dikonfirmasi oleh Manager {$name_user}.", $id_user_cancellation);

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
        Customer has been terminated!</div>');

        redirect('manager/index');
    }

    public function btnAction($id_customer)
    {
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $status = $data['customer']['status'];
        $information = $data['customer']['information'];
        // print_r($status);

        if ($information == 'Waiting For Confirmation') {
            redirect('manager/getCancellation/' . $id_customer);
        } else {
            redirect('manager/detailCustomer/' . $id_customer);
        }
    }

    public function detailCustomer($id_customer)
    {
        $data['title'] = 'Detail Customer';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['report'] = $this->M_Report->getReportByIdCustomer($id_customer);
        $data['customer'] = $this->M_Report->getCustomerById($id_customer);
        $data['user_closing'] = $this->M_Manager->getInfoClosing($id_customer);
        $data['user_energize'] = $this->M_Manager->getFileEnergize($id_customer);
        $data['notif'] = get_new_notif();

        // print_r($data['user_closing']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/detail_customer', $data);
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
            $this->load->view('manager/detail-user-report', $data);
            // print_r($data['report_row']);
            // print_r($data['report_row']);
            // $data['customerss'] = $this->M_Report->getReportByIdCustomer();
            // print_r($id_customers);
        }
    }

    public function getCancellation($id_customer)
    {
        $data['title'] = 'Info Cancellation';
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();
        $data['customer'] = $this->M_Manager->getCustomerById($id_customer);
        $data['user_cancellation'] = $this->M_Manager->getCancellationById($id_customer);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/cancellation', $data);
        $this->load->view('templates/footer');
    }


    public function notification()
    {
        $data['title'] = 'Notification';
        $data['customers'] = $this->M_Manager->getCustomer();
        $data['user'] = $this->M_Auth->getUserByEmail($this->session->userdata('email'));
        $data['notif'] = get_new_notif();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('manager/notification', $data);
        $this->load->view('templates/footer');
    }
}
