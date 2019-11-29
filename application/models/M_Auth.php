<?php
class M_Auth extends CI_Model
{
    public function getUserByEmail($email)
    {
        $this->db->select('user.*,user_role.role_type');
        $this->db->join('user_role', 'user.id_role = user_role.id_role');
        return $this->db->get_where('user', ['email' => $email])->row_array();
    }

    public function getUserById($id_user)
    {
        return $this->db->get_where('user', ['id_user' => $id_user])->row_array();
    }

    public function getUserRole()
    {
        return $this->db->get('user_role')->result_array();
    }

    public function getUserRoleById($id_role)
    {
        return $this->db->get_where('user_role', ['id_role' => $id_role])->row_array();
    }

    public function getUserMenu()
    {
        return $this->db->get('user_menu')->result_array();
    }

    public function getUserMenuById($id_user_menu)
    {
        $this->db->where('id_user_menu !=', 1);
        return $this->db->get('user_menu')->result_array();
    }

    public function getUserAccessMenuBy($data)
    {
        return $this->db->get_where('user_access_menu', $data);
    }

    public function addUser($data)
    {
        $this->db->insert('user', $data);
    }

    public function addUserMenu($data)
    {
        $this->db->insert('user_menu', $data);
    }

    public function addUserSubMenu($data)
    {
        $this->db->insert('user_sub_menu', $data);
    }


    public function addUserAccessMenu($data)
    {
        $this->db->insert('user_access_menu', $data);
    }

    public function deleteUserAccessMenu($data)
    {
        $this->db->delete('user_access_menu', $data);
    }
}
