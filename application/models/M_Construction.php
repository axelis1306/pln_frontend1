<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Construction extends CI_Model
{
    public function getCustomer()
    {
        $this->db->select('*');
        $this->db->from('customer');
        $this->db->join('service', 'customer.id_type_of_service = service.id_type_of_service');
        $this->db->join('status', 'customer.id_status = status.id_status');
        $this->db->join('tariff', 'customer.id_tariff = tariff.id_tariff');
        $this->db->join('information', 'customer.id_information = information.id_information');
        return $this->db->get()->result_array();
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


    public function getService()
    {
        $this->db->order_by('id_type_of_service', 'DESC');
        return $this->db->get('service')->result_array();
    }

    public function getSubstation()
    {
        $this->db->order_by('id_substation', 'DESC');
        return $this->db->get('substation')->result_array();
    }

    public function getFeederSubstation()
    {
        $this->db->order_by('id_feeder_substation', 'DESC');
        return $this->db->get('feeder_substation')->result_array();
    }

    public function getInfoClosing($id_customer)
    {
        $this->db->select('user_closing.*,user.name');
        $this->db->join('user', 'user_closing.id_user = user.id_user');
        return $this->db->get_where('user_closing', ['id_customer' => $id_customer])->row_array();
    }

    public function addPotencial($data)
    {
        return $this->db->insert('potencial_customer', $data);
    }

    public function addCustomer($data)
    {
        return $this->db->insert('customer', $data);
    }
    public function addUserClosing($data)
    {
        return $this->db->insert('user_closing', $data);
    }
}
