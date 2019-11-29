<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
* Excel library for Code Igniter applications
* Author: Federico Ramírez a.k.a fedekun a.k.a lenkun - Feb 2010
*/
class to_excel_pi{ 
	function to_excel($array, $filename='out') {
		header('Content-type: application/vnd.ms-excel');
		header('Content-Disposition: attachment; filename='.$filename.'.xls');
		
		// Filter all keys, they'll be table headers
		$h = array();
		foreach($array as $row)
			foreach($row as $key=>$val)
				if(!in_array($key, $h))
					$h[] = $key;
		
		echo '<table><tr>';
		foreach($h as $key) {
			$key = ucwords($key);
			echo '<th>'.$key.'</th>';
		}
		echo '</tr>';
		
		foreach($array as $val)
			$this->_writeRow($val, $h);
		
		echo '</table>';
	}

	public function _writeRow($row, $h, $isHeader=false) {
		echo '<tr>';
		foreach($h as $r) {
			if($isHeader)
				echo '<th>'.utf8_decode(@$row[$r]).'</th>';
			else
				echo '<td>'.utf8_decode(@$row[$r]).'</td>';
		}
		echo '</tr>';
	}  
}