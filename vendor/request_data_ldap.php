<?php
$usn = $_GET['username'];
$pswd = $_GET['password'];
	
$ldap= array();		
/* ### Active Directory Address and usn/pwd ### */
$ad_server = "10.1.8.30";
$ad_dn	= "OU=UID JAYA,OU=OPERASIONAL JAKARTA 1,OU=REGIONAL JAWA BALI NUSRA,DC=pusat,DC=corp,DC=pln,DC=co,DC=id"; 	
$ad_usn_postfix	= "@pusat.corp.pln.co.id";

//Connect to Active Directory
$ad = ldap_connect("ldap://10.1.8.20");
ldap_set_option($ad, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ad, LDAP_OPT_REFERRALS, 0);
	
$adusn = $usn.$ad_usn_postfix; 
$adpwd = $pswd;
	
$bind = @ldap_bind($ad, $adusn, $adpwd);

$ldapErr = ldap_errno($ad);

if ($ldapErr==0) { //login domain success
	$ldap_search_param = "(&"."(sAMAccountName=$usn)".")";
	$ldap_search_return = array('office','displayname','employeenumber','mail','company','department','title','telephonenumber','physicaldeliveryofficename');
				
	$search = ldap_search($ad, $ad_dn, $ldap_search_param, $ldap_search_return);
	$entries = ldap_get_entries($ad, $search);
				
	$AD_displayName = substr(str_replace("'","\'",$entries[0]['displayname'][0]),0,150);
	$AD_employeeNumber = substr(str_replace("'","\'",$entries[0]['employeenumber'][0]),0,14);
	$AD_mail = substr(str_replace("'","\'",$entries[0]['mail'][0]),0,150);
	$AD_company = substr(str_replace("'","\'",$entries[0]['company'][0]),0,150);
	$AD_department = substr(str_replace("'","\'",$entries[0]['department'][0]),0,150);
	$AD_title = substr(str_replace("'","\'",$entries[0]['title'][0]),0,150);
	$AD_office = substr(str_replace("'","\'",$entries[0]['office'][0]),0,150);
	$telephoneNumber = substr(str_replace("'","\'",$entries[0]['telephonenumber'][0]),0,150);
	$physicalDeliveryOfficeName = substr(str_replace("'","\'",$entries[0]['physicaldeliveryofficename'][0]),0,150);
	
	$ldap['info']= array(
			array(
			'display_name' => $AD_displayName,
			'employee_number' => $AD_employeeNumber,
			'mail' => $AD_mail,
			'company' => $AD_company,
			'department' => $AD_department,
			'title' => $AD_title,
			'telephone_number' => $telephonenumber,
			'area' => $physicalDeliveryOfficeName,
			'office' => $AD_office
			)
		);
	/*echo $AD_displayName."<br/>";
	echo $AD_employeeNumber."<br/>";
	echo $AD_mail."<br/>";
	echo $AD_company."<br/>";
	echo $AD_department."<br/>";
	echo $AD_title."<br/>";
	echo $telephoneNumber."<br/>";
	echo $physicalDeliveryOfficeName."<br/>";*/

}


echo json_encode($ldap);
?>