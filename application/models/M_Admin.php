<?php
class M_Admin extends CI_Model
{
  public function getService()
  {
    $this->db->order_by('id_type_of_service', 'DESC');
    return $this->db->get('service')->result_array();
  }

  public function addRole($data)
  {
    $this->db->insert('user_role', $data);
  }

  public function getRoleById($data)
  {
    return $this->db->get_where('user_role', ['id_role' => $data])->row_array();
  }

  public function deleteRoleById($id_role)
  {
    // $query = "SELECT IDENT_CURRENT('user_role')";
    // return $this->db->query($query)->result_array();

    $this->db->where('id_role', $id_role);
    return $this->db->delete('user_role');
  }

  public function getNotif($id_notification_target)
  {
    $this->db->select('notification_target.id_notification_target,notification.title,notification.details,notification.created_at,user.name,customer.name_customer,customer.id_customer,type_notification.id_type_notification,type_notification.icon_notification,type_notification.bg_color');
    $this->db->where('id_notification_target', $id_notification_target);
    $this->db->from('notification_target');
    $this->db->join('notification', 'notification_target.id_notification = notification.id_notification');
    $this->db->join('type_notification', 'notification.id_type_notification = type_notification.id_type_notification');
    $this->db->join('customer', 'notification.id_customer = customer.id_customer');
    $this->db->join('user', 'notification.id_user = user.id_user');
    return $this->db->get()->result_array();
  }


  // public function uploadProblemMapping($id_customer)
  // {
  //   $name_customer = $this->input->post('customer');
  //   $address_customer = $this->input->post('address-customer');
  //   $tarif = $this->input->post('tariff');
  //   $daya = $this->input->post('power');
  //   $dropDown = $this->input->post('dropDown');
  //   $captive_power = $this->input->post('captive-power');
  //   $amount_of_power = $this->input->post('amount-of-power');
  //   $next_meeting = $this->input->post('next-meeting');
  //   $suggestion = $this->input->post('suggestion');

  //   $company_name = $this->input->post('company-name');
  //   $address_company = $this->input->post('address-company');
  //   $phone_company = $this->input->post('phone-company');
  //   $facsimile = $this->input->post('facsimile');
  //   $email_company = $this->input->post('email-company');
  //   $establishment = $this->input->post('establishment');

  //   $company_leader_name = $this->input->post('company-leader-name');
  //   $leader_position_company = $this->input->post('leader-position-company');
  //   $phone_leader_company = $this->input->post('phone-leader-company');
  //   $email_leader_company = $this->input->post('email-leader-company');

  //   $company_finance_name = $this->input->post('company-finance-name');
  //   $finance_position_company = $this->input->post('finance-position-company');
  //   $phone_finance_company = $this->input->post('phone-finance-company');
  //   $email_finance_company = $this->input->post('email-finance-company');

  //   $company_engineering_name = $this->input->post('company-engineering-name');
  //   $engineering_position_company = $this->input->post('engineering-position-company');
  //   $phone_engineering_company = $this->input->post('phone-engineering-company');
  //   $email_engineering_company = $this->input->post('email-engineering-company');

  //   $company_general_name = $this->input->post('company-general-name');
  //   $general_position_company = $this->input->post('general-position-company');
  //   $phone_general_company = $this->input->post('phone-general-company');
  //   $email_general_company = $this->input->post('email-general-company');

  //   $data = array(
  //     'name_company' => $company_name,
  //     'address_company' => $address_company,
  //     'phone' => $phone_company,
  //     'facsimile' => $facsimile,
  //     'email_company' => $email_company,
  //     'date_of_establishment' => $establishment
  //   );
  //   $id_company_profile = $this->insert_get('company_profile', $data, 'id_company_profile');

  //   $data = $this->set_data('name_company_leader', $company_leader_name, $leader_position_company, $phone_leader_company, $email_leader_company);
  //   $id_company_leader = $this->insert_get('company_leader', $data, 'id_company_leader');

  //   $data = $this->set_data('name_company_finance', $company_finance_name, $finance_position_company, $phone_finance_company, $email_finance_company);
  //   $id_company_finance = $this->insert_get('company_finance', $data, 'id_company_finance');

  //   $data = $this->set_data('name_company_engineering', $company_engineering_name, $engineering_position_company, $phone_engineering_company, $email_engineering_company);
  //   $id_company_engineering = $this->insert_get('company_engineering', $data, 'id_company_engineering');

  //   $data = $this->set_data('name_company_general', $company_general_name, $general_position_company, $phone_general_company, $email_general_company);
  //   $id_company_general = $this->insert_get('company_general', $data, 'id_company_general');

  //   $data = array(
  //     'id_company_profile' => $id_company_profile,
  //     'id_company_leader' => $id_company_leader,
  //     'id_company_finance' => $id_company_finance,
  //     'id_company_engineering' => $id_company_engineering,
  //     'id_company_general' => $id_company_general,
  //     'name_customer' => $name_customer,
  //     'address_customer' => $address_customer,
  //     'tariff' => $tarif,
  //     'power' => $daya,
  //     'id_type_of_service' => $dropDown,
  //     'id_status' => 2,
  //     'id_information' => 2,
  //     'captive_power' => $captive_power,
  //     'amount_of_power' => $amount_of_power,
  //     'next_meeting' => $next_meeting,
  //     'suggestion' => $suggestion
  //   );

  //   $this->db->where('id_customer', $id_customer);
  //   return ($this->db->update('customer', $data) != 1) ? false : true;
  // }

  // public function set_data($name, $value1, $value2, $value3, $value4)
  // {
  //   $data = array(
  //     $name => $value1,
  //     'position' => $value2,
  //     'phone' => $value3,
  //     'email' => $value4
  //   );
  //   return $data;
  // }

  // public function insert_get($table, $data, $id_kolom)
  // {
  //   $this->db->insert($table, $data);
  //   $temp = $this->db->query("SELECT $id_kolom FROM $table ORDER BY $id_kolom DESC LIMIT 1")->result_array();
  //   $id = 0;
  //   foreach ($temp as $ids) {
  //     $id = $ids[$id_kolom];
  //   }
  //   return $id;
  // }
}
