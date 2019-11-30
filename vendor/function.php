<?php

function get_gd($connection){
	$sql = "select NAMA_AREA,KODE_ASET_GDIST, GARDU,GPS_X, GPS_Y from
        (select rownum as rownumber,g.kode_aset_gi, g.nama_gi,
         a.NAMA_AREA, t.* 
          from G_GARDU_DISTRIBUSI t, PENYULANG p, area a, GI g
          where a.kdarea=t.kdarea and p.kode_aset_pny=t.kode_aset_pny 
              and p.kode_aset_gi=g.kode_aset_gi 
        )
        where rownumber between 1 AND 50000 and gps_x is not null
    order by  kode_aset_gdist";
	//echo $sql;	
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

function get_info_gd($connection,$KODE_ASET_GDIST){
	$sql = "select a.*,c.* from HASIL_UKUR a,E_TRAFO b,INSP_GARDU_MAIN c, 
		(SELECT MAX(TGL_CREATE) AS TGL_CREATE FROM INSP_GARDU_MAIN WHERE  KODE_ASET_GDIST = '$KODE_ASET_GDIST')d
		where a.ID_HASIL_UKUR = b.ID_HASIL_UKUR and a.KODE_ASET_TRAFO is not null 
		and c.TGL_CREATE = d.TGL_CREATE and c.KODE_ASET_GDIST = '$KODE_ASET_GDIST'
		and a.KODE_ASET_GDIST = '$KODE_ASET_GDIST' order by KODE_ASET_TRAFO asc";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}

	return $data;
	oci_close($connection);
}

function get_info_gd_foto($connection,$KODE_ASET_GDIST){
	$sql = "SELECT * FROM INSP_GARDU_MAIN A,
		(SELECT MAX(TGL_CREATE) AS TGL_CREATE FROM INSP_GARDU_MAIN WHERE  KODE_ASET_GDIST = '$KODE_ASET_GDIST')B
		WHERE A.KODE_ASET_GDIST = '$KODE_ASET_GDIST' AND A.TGL_CREATE = B.TGL_CREATE";
	//echo $sql;	
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}

	return $data;
	oci_close($connection);
}


function get_gi($connection){
	$sql = "select * from GI";
	//echo $sql;	
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

function get_tiang($connection,$LATIT,$LONGIT,$JARAK){
	$sql = "select * from TIANG";
	//echo $sql;	
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}



function get_info_gi($connection,$KODE_ASET_GI){
	$sql = "select pa.*,p.KODE_ASET_PNY from PENYULANG p, PENYULANG_APD pa WHERE p.NAMA = pa.FEEDER and p.KODE_ASET_GI = '$KODE_ASET_GI'";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

function get_gd_titik($connection,$LATITUDE,$LONGITUDE,$JARAK){
	$sql = "select NAMA_AREA,KODE_ASET_GDIST, GARDU,GPS_X, GPS_Y, JARAK *1000  AS JARAK,
			KODE_ASET_TRAFO,KAPASITAS,PERSEN_DAYA_TRAFO,PERSEN_FASA_MAX,TGL_UKUR,JAM_UKUR from (
			 select t.kode_aset_gdist,t.gardu,t.gps_x,t.gps_y,a.nama_area,
			d.kode_aset_trafo,d.kapasitas,d.persen_daya_trafo,d.persen_fasa_max,d.tgl_ukur,d.jam_ukur,
			(6371 * acos( cos(radians($LATITUDE)) * cos(radians(gps_x)) * cos(radians(gps_y) - radians($LONGITUDE)) + sin(radians($LATITUDE)) * sin(radians(gps_x )))) AS JARAK 
			from G_GARDU_DISTRIBUSI t, area a ,e_trafo b, e_trafo_gd c, hasil_ukur d where a.kdarea=t.kdarea and t.kode_aset_gdist = c.kode_aset_gdist and  b.id_trafo = c.id_trafo and b.id_hasil_ukur = d.id_hasil_ukur order by JARAK asc) 
			where gps_x is not null and (JARAK * 1000) < $JARAK";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

function get_tiang_titik($connection,$LATITUDE,$LONGITUDE,$JARAK){
	$sql = "select ID_TIANG ,X GP_X, Y GP_Y, JARAK *1000  AS JARAK from (
			 select t.ID_TIANG,t.x,t.y,
			(6371 * acos( cos(radians($LATITUDE)) * cos(radians(x)) * cos(radians(y) - radians($LONGITUDE)) + sin(radians($LATITUDE)) * sin(radians(x )))) AS JARAK 
			from tiang t order by JARAK asc) 
			where x is not null and (JARAK * 1000) < $JARAK";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_object($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

function insert_penyulang($connection,$connection_apd){
	$sql = "select FEEDER,ARUS_MAX,BEBAN_A,BEBAN_MW,BEBAN_V,to_date(tgl_beban_a,'DD/MM/YYYY HH24:MI:SS') AS TGL_BEBAN_A from SCADA.TBL_FEEDER";
	//echo $sql;
	$statement = oci_parse($connection_apd,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_array($statement)){
		$sql = "INSERT INTO PENYULANG_APD_TEMP(FEEDER,ARUS_MAX,BEBAN_A,BEBAN_MW,BEBAN_V,TGL_BEBAN_A)  values(
				'".$rows['FEEDER']."',
				'".$rows['ARUS_MAX']."',
				'".$rows['BEBAN_A']."',
				'".$rows['BEBAN_MW']."',
				'".$rows['BEBAN_V']."',
				'".$rows['TGL_BEBAN_A']."')";
		echo $sql;
		/*$statement = oci_parse($connection,$sql);
		oci_execute($statement);*/
		//$rows['AJ'];
	}
}

function get_ip_address($FormatIpForDatabaseInput = "0"){
	if (getenv("HTTP_CLIENT_IP"))
			$ip = getenv("HTTP_CLIENT_IP");
		else if(getenv("HTTP_X_FORWARDED_FOR"))
			$ip = getenv("HTTP_X_FORWARDED_FOR");
		else if(getenv("REMOTE_ADDR"))
			$ip = getenv("REMOTE_ADDR");
		else
			$ip = "UNKNOWN";
	return $ip;
}

function insert_login($connection,$browser,$username,$area){
	$ip_addr = get_ip_address();
	$sql = "insert into PETRA_LOGS(BROWSER,IP_ADDR,USERNAME,AREA) values('".$browser."','".$ip_addr."','".$username."','".$area."')";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	oci_close($connection);
}

function get_jurusan($connection,$kode_aset_gdist){
	$sql = "select A.* from V_KURBAN_HASIL_UKUR_JURUSAN A, 
			(select max(id_hasil_ukur) AS ID_HASIL_UKUR from V_KURBAN_HASIL_UKUR_JURUSAN where KODE_ASET_GDIST = '$kode_aset_gdist')B	
			WHERE A.ID_HASIL_UKUR = B.ID_HASIL_UKUR";
	//echo $sql;
	$statement = oci_parse($connection,$sql);
	oci_execute($statement);
	while($rows = oci_fetch_array($statement)){
		$data[] = $rows;
	}
	return $data;
	oci_close($connection);
}

?>