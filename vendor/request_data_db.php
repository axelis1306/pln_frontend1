<?php
ini_set('memory_limit', '-1');
include('function.php');

$ora_username	= "siastra_test";
$ora_password	= "asti2014";
$ora_service	= "10.3.0.15/EMAP";
$connection 	 = oci_connect($ora_username, $ora_password, $ora_service);

$ora_username_apd	= "kd";
$ora_password_apd	= "kd123";
$ora_service_apd	= "10.3.187.13/OFDB";
$connection_apd 	 = oci_connect($ora_username_apd, $ora_password_apd, $ora_service_apd);

$data = array();
if(isset($_GET['GD'])){
	$data['GD'] = get_gd($connection);
}else if(isset($_GET['INFO_GD'])){
	$kode_aset_gdist = $_GET['kode_aset_gdist'];
	$data['INFO_GD'] = get_info_gd($connection, $kode_aset_gdist);
	//$data['FOTO']	 =	 get_info_gd_foto($connection, $kode_aset_gdist);
}else if(isset($_GET['GI'])){
	$data['GI'] = get_gi($connection);
}else if(isset($_GET['INFO_GI'])){
	$kode_aset_gi = $_GET['kode_aset_gi'];
	$data['INFO_GI'] = get_info_gi($connection, $kode_aset_gi);
}else if(isset($_GET['LATITUDE'])){
	$LATITUDE = $_GET['LATITUDE'];
	$LONGITUDE = $_GET['LONGITUDE'];
	$JARAK = $_GET['JARAK'];
	$data['SEARCH_TRAFO'] = get_gd_titik($connection,$LATITUDE,$LONGITUDE,$JARAK);
	//$data1['SEARCH_TIANG'] = get_tiang_titik($connection,$LATITUDE,$LONGITUDE,$JARAK); 
}else if(isset($_GET['LATIT'])){
	$LATITUDE = $_GET['LATIT'];
	$LONGITUDE = $_GET['LONGIT'];
	$JARAK = $_GET['JARAK'];
	//$data['SEARCH_TRAFO'] = get_gd_titik($connection,$LATITUDE,$LONGITUDE,$JARAK);
	$data['SEARCH_TIANG'] = get_tiang_titik($connection,$LATITUDE,$LONGITUDE,$JARAK); 
}else if(isset($_GET['username'])){
	$browser = $_GET['browser'];
	$username = $_GET['username'];
	$area = $_GET['area'];
	insert_login($connection,$browser,$username,$area);
}else if(isset($_GET['penyulang'])){
	insert_penyulang($connection,$connection_apd);
}else if(isset($_GET['jurusan'])){
	$kode_aset_gdist = $_GET['kode_aset_gdist'];
	$data['JURUSAN'] = get_jurusan($connection,$kode_aset_gdist);
}
echo json_encode($data);

?>