<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Planning extends CI_Model
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

    public function getTariff()
    {
        return $this->db->get('tariff')->result_array();
    }

    public function getService()
    {
        $this->db->order_by('id_type_of_service', 'DESC');
        return $this->db->get('service')->result_array();
    }

    public function getServiceByService($data)
    {
        $this->db->select('id_type_of_service');
        return $this->db->get_where('service', ['type_of_service' => $data])->result_array();
    }

    public function getSubstation()
    {
        $this->db->order_by('id_substation', 'DESC');
        return $this->db->get('substation')->result_array();
    }
    public function getSubstationBySubstation($data)
    {
        $this->db->select('id_substation');
        return $this->db->get_where('substation', ['name_substation' => $data])->result_array();
    }

    public function getFeederSubstation()
    {
        $this->db->order_by('id_feeder_substation', 'DESC');
        return $this->db->get('feeder_substation')->result_array();
    }

    public function getFeederSubstationByFeederSubstation($data)
    {
        $this->db->select('id_feeder_substation');
        return $this->db->get_where('feeder_substation', ['name_feeder_substation' => $data])->result_array();
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

    public function getIdTariffByTariff($data)
    {
        $this->db->select('id_tariff');
        return $this->db->get_where('tariff', ['tariff' => $data])->result_array();
    }
}
