<?php
defined('BASEPATH') or exit('No direct script access allowed');

class M_Menu extends CI_Model
{

    public function getSubMenu()
    {
        $query = "SELECT `user_sub_menu`.*, `user_menu`.`menu`
                  FROM `user_sub_menu` JOIN `user_menu`
                  ON `user_sub_menu`.`id_user_menu` = `user_menu`.`id_user_menu`
                  ";

        return $this->db->query($query)->result_array();
    }

    public function getSubMenuById($id_user_sub_menu)
    {
        return $this->db->get_where('user_sub_menu', ['id_user_sub_menu' => $id_user_sub_menu])->row_array();
    }

    public function getUserMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }
}
