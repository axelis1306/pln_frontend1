<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth');
    } else {
        $id_role = $ci->session->userdata('id_role');
        $menu = $ci->uri->segment(1);
        if ($menu == 'accountexecutive') {
            $menu = 'Account Executive';
        }


        $queryMenu = $ci->db->get_where('user_menu', ['menu' =>  $menu])->row_array();
        $id_menu = $queryMenu['id_user_menu'];
        $userAccess = $ci->db->get_where('user_access_menu', [
            'id_role' => $id_role,
            'id_user_menu' => $id_menu
        ]);

        if ($userAccess->num_rows() < 1) {
            redirect('auth/blocked');
        }
    }
}

function check_access($id_role, $id_menu)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_access_menu', ['id_role' => $id_role, 'id_user_menu' => $id_menu]);

    if ($result->num_rows() > 0) {
        return "checked='checked'";
    }
}

function check_access_active($id_user_sub_menu)
{
    $ci = get_instance();

    $result = $ci->db->get_where('user_sub_menu', ['id_user_sub_menu' => $id_user_sub_menu])->row_array();
    $is_active = $result['is_active_menu'];

    if ($is_active > 0) {
        return "checked='checked'";
    }
}

function truncateText($text, $chars = 25)
{
    if (strlen($text) <= $chars) {
        return $text;
    }
    $text = $text . " ";
    $text = substr($text, 0, 19);
    // $text = substr($text, 0, strrpos($text, ' '));
    $text = $text . "..";
    return $text;
}

function change_format_time($timestamp)
{
    $timestamp = (string) $timestamp;
    $datetime = explode(' ', $timestamp);
    $date = explode('-', $datetime[0]);
    $time = explode(':', $datetime[1]);

    return $date + " " + $time;
}

function open_folder($name_customer, $timestamp)
{
    $ci = get_instance();
    $rep = str_replace(':', '-', $timestamp);
    $folder = 'assets/report/' . $name_customer . '/' . $rep . '/';
    // $map = directory_map($folder);

    return $folder;
}

function open_folder_cancellation($name_customer)
{
    $ci = get_instance();
    $folder = 'assets/berkas/' . $name_customer . '/Cancellation Folder' . '/';
    // $map = directory_map($folder);

    return $folder;
}

function get_new_notif()
{
    $ci = get_instance();
    $id_user = $ci->session->userdata('id_user');
    $ci->db->select('notification_target.*,notification.created_at');
    $ci->db->join('notification', 'notification.id_notification = notification_target.id_notification');
    $ci->db->order_by("created_at", "DESC");
    $query = $ci->db->get_where('notification_target', ['id_target' => $id_user, 'status_read' => 0])->result_array();

    $notifications = array();
    foreach ($query as $notif) {
        $notification = $ci->M_Admin->getNotif($notif['id_notification_target']);
        array_push($notifications, $notification);
    }
    return $notifications;
}

function count_notif($menu)
{
    $ci = get_instance();

    $ci->db->select('count(*) as t');
    $ci->db->join('notification', 'notification_target.id_notification = notification.id_notification');
    $ci->db->join('type_notification', 'notification.id_type_notification = type_notification.id_type_notification');
    $t = $ci->db->get_where('notification_target', ['notification_target.id_target' => $ci->session->userdata('id_user'), 'notification_target.status_read' => 0, 'type_notification.menu' => $menu])->result_array()[0];
    return ($t['t']);
}
