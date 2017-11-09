<?php

include_once'conn.php';
$code = $_GET['id'];
$email = $_GET['email'];

$que = $db->rawQuery('SELECT * FROM temp_log WHERE code=? AND email=?',[$code,$email]);
if(!empty($que)) {
	$db->rawQuery('DELETE FROM temp_log WHERE code=? AND email=?',[$code,$email]);
	$db->rawQuery('UPDATE login SET is_active=1 WHERE email=?',[$code,$email]);
}

?>
<script type="text/javascript">
	alert("You have been successfully registered");
	window.location.replace("/");
</script>