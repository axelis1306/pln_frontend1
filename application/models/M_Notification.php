<?php 

class M_Notification extends CI_Model{
	public function readNotif($id_notification_target){
		$this->db->set('status_read',1);
		$this->db->where('id_notification_target',$id_notification_target);
		$this->db->update('notification_target');
	}
	public function setNotification($id_customer ,$id_user,$id_type_notification ,$title , $details, $target){
		$type = $this->db->get_where('type_notification',['id_type_notification'=>$id_type_notification])->row_array();
		$this->db->insert('notification',['id_customer'=>$id_customer,'id_user'=>$id_user,'id_type_notification'=>$id_type_notification,'title'=>$title, 'details'=>$details]);
		$id_notif = $this->db->get_where('notification',['id_customer'=>$id_customer,'id_user'=>$id_user,'id_type_notification'=>$id_type_notification,'title'=>$title, 'details'=>$details])->row_array();
		if($type['type_notification'] == 'Single'){
			
			$this->db->insert('notification_target',['id_notification'=>$id_notif['id_notification'],'id_target'=>$target]);	
			
		}else{						
			$targets = $this->db->get_where('user',['id_role'=>$type['id_role']])->result_array();			
			foreach ($targets as $target) {
				$this->db->insert('notification_target',['id_notification'=>$id_notif['id_notification'],'id_target'=>$target['id_user']]);	
			}
		
		}

	}
}

 ?>