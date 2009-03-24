<?php
$conn = mysql_connect("localhost", "root", "");

if (!$conn) {
    echo "Unable to connect to DB: " . mysql_error();
    exit;
}
  
if (!mysql_select_db("tuftsph_jm2db")) {
    echo "Unable to select mydbname: " . mysql_error();
    exit;
}

$sql = "SELECT * FROM jobs WHERE 1";

$result = mysql_query($sql);

$total = mysql_affected_rows();
$count = 0;

while ($row = mysql_fetch_assoc($result)) {
	
	$sql = array();
	
	foreach($row as $key => $val){
		$val = preg_replace("/(\r\n)+/", "<br/>", $val);
		$val = preg_replace("/(\n)+/", "<br/>", $val);
		
		$sql[] = " " . $key . " = '" . $val . "'";
	}
	
	mysql_query( "UPDATE jobs SET " . join(",", $sql) . " WHERE id = " . $row["id"] );
	
	$count += 1;
	
	echo ($count / $total) * 100 . "\n";
}

?>