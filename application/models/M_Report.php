<?php
class M_Report extends CI_Model
{
    public function addUserReport($data)
    {
        return $this->db->insert('user_report', $data);
    }

    public function addCancellationReport($data)
    {
        return $this->db->insert('user_cancellation', $data);
    }

    public function addReport($data)
    {
        return $this->db->insert('user_report', $data);
    }

    public function getCustomer()
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('service', 'customer.id_type_of_service = service.id_type_of_service');
        $this->db->join('status', 'customer.id_status = status.id_status');
        $this->db->join('tariff', 'customer.id_tariff = tariff.id_tariff');
        return $this->db->get()->result_array();
    }

    public function getReport()
    {
        return $this->db->get('user_report')->result_array();
    }



    public function getCustomerById($id_customer)
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('tariff', 'customer.id_tariff = tariff.id_tariff');
        $this->db->join('service', 'customer.id_type_of_service = service.id_type_of_service');
        $this->db->join('status', 'customer.id_status = status.id_status');
        $this->db->join('information', 'customer.id_information = information.id_information');
        $this->db->join('substation', 'customer.id_substation = substation.id_substation');
        $this->db->join('feeder_substation', 'customer.id_feeder_substation = feeder_substation.id_feeder_substation');
        $this->db->where('id_customer', $id_customer);
        return $this->db->get()->row_array();
    }

    public function getCancellationByIdCustomer($id_customer)
    {
        return $this->db->get_where('user_cancellation', ['id_customer' => $id_customer])->row_array();
    }

    public function getUserReportByIdUser($id_user)
    {
        return $this->db->get_where('user', ['id_user' => $id_user])->result_array();
    }

    // public function getReportByIdCustomer($id_customers)
    // {
    //     $query = $this->db->get_where('user_report', ['id_customer' => $id_customers]);

    //     if ($query->num_rows() > 0) {
    //         foreach ($query->result() as $row) {
    //             return $array = json_decode(json_encode($row), true);
    //         }
    //     }
    //     return false;
    // }

    public function getReportByIdCustomer($where)
    {
        $query = "SELECT `user_report`.*, `customer`.`name_customer`, `user`.`name`, `user_role`.`role_type`
        FROM `user_report` JOIN `customer` ON `user_report`.`id_customer` = `customer`.`id_customer`
        JOIN `user` ON `user_report`.`id_user` = `user`.`id_user`
        JOIN `user_role` ON `user`.`id_role` = `user_role`.`id_role` where `customer`.`id_customer` = $where";
        return $this->db->query($query)->result_array();
    }

    public function getReportById($id_user_report)
    {
        return $this->db->get_where('user_report', ['id_user_report' => $id_user_report])->row_array();
    }

    public function getReportByIdUserReport($where)
    {
        $query = "SELECT `user_report`.*, `customer`.`name_customer`, `user`.`name`, `user_role`.`role_type`
        FROM `user_report` JOIN `customer` ON `user_report`.`id_customer` = `customer`.`id_customer`
        JOIN `user` ON `user_report`.`id_user` = `user`.`id_user`
        JOIN `user_role` ON `user`.`id_role` = `user_role`.`id_role` where `user_report`.`id_user_report` = $where";
        return $this->db->query($query)->row_array();
    }
}
