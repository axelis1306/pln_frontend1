<?php

if(isset($_GET['SKTM_MENTENG'])){
	$url = "http://pelita.plnjaya.co.id:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_MENTENG&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_BANDENGAN'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_BANDENGAN&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_KEBON_JERUK'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_KEBON_JERUK&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_CIRACAS'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_CIRACAS&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_BINTARO'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_BINTARO&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_BULUNGAN'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_BULUNGAN&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_CEMPAKA_PUTIH'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_CEMPAKA_PUTIH&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_CENGKARENG'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_CENGKARENG&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_CIPUTAT'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_CIPUTAT&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_JATINEGARA'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_JATINEGARA&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_KRAMAT_JATI'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_KRAMAT_JATI&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_LENTENG_AGUNG'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_LENTENG_AGUNG&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_MARUNDA'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_MARUNDA&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_PONDOK_GEDE'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_PONDOK_GEDE&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_PONDOK_KOPI'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_PONDOK_KOPI&outputFormat=application%2Fjson";
	set_content($url);
}else if(isset($_GET['SKTM_TANJUNG_PRIOK'])){
	$url = "http://localhost:4321/geoserver/DGIS/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=DGIS:SKTM_TANJUNG_PRIOK&outputFormat=application%2Fjson";
	set_content($url);
}





function set_content($url1){
	$url=file_get_contents($url1); 
	echo($url);
}
?>