<?php

class Notification extends CI_Controller
{
	public function readNotif()
	{
		// $id_notification_target= $this->input->post('id_notification_target');
		$id_notification_target =  $this->uri->segment(3);
		$id_customer =  $this->uri->segment(4);
		$id_type_notification =  $this->uri->segment(5);

		$id_role = $this->session->userdata('id_role');
		$this->load->model('M_Notification');
		$this->M_Notification->readNotif($id_notification_target);
		if ($id_type_notification == 12) {
			redirect('manager/detailCustomer/' . $id_customer);
		} elseif ($id_type_notification == 13) {
			redirect('planning/dataForReksis');
		} elseif ($id_type_notification == 14) {
			redirect('construction/detailCustomer/' . $id_customer);
		} elseif ($id_type_notification == 2) {
			redirect('accountexecutive/index');
		} elseif ($id_type_notification == 15) {
			redirect('construction/index');
		} elseif ($id_type_notification == 8) {
			redirect('manager/detailCustomer/' . $id_customer);
		} elseif ($id_type_notification == 4) {
			redirect('manager/detailCustomer/' . $id_customer);
		} elseif ($id_type_notification == 10) {
			redirect('accountexecutive/index');
		} elseif ($id_type_notification == 16) {
			redirect('manager/detailCustomer/' . $id_customer);
		} elseif ($id_type_notification == 6) {
			redirect('accountexecutive/index');
		} elseif ($id_type_notification == 5) {
			redirect('manager/getCancellation/' . $id_customer);
		}
		// redirect("user/detailCustomer/" . $id_customer);
	}
	public function setNotif()
	{
		$id_customer = $this->uri->segment(3);
		$id_user = $this->uri->segment(4);
		$id_type_notification = $this->uri->segment(5);
		$title = $this->uri->segment(6);
		$details = $this->uri->segment(7);
		$target = $this->uri->segment(8);
		$redir = $this->uri->segment(9);

		// $this->M_Notification->setNotification(1 ,5,3 ,'Broadcast' , 'Test Broadcast', 5);
		$this->M_Notification->setNotification($id_customer, $id_user, $id_type_notification, $title, $details, $target);
		redirect();
		// kalo mau make tinggal tambahin ini aja
		// redirect('Notification/setNotif/<id_customer>/<id_user>/<id_type_notification>/<title>/<details>/<target>')
	}
}
