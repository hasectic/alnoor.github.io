<?php

include_once'conn.php';

if($_POST['pwd'] != $_POST['cpwd']) {
	$str = ["msg"=>"Passwords not match","type"=>2];
	echo json_encode($str);
	exit;
}

$data = ['email' => $_POST['email'], 'name' => $_POST['email'],'pwd' => $_POST['email'],
		'type' => $_POST['email'],'user' => mt_rand(100000,999999), 'is_active' => 0];
$id = $db->insert ('login', $data);

if($id) {
	$code = sha1(mt_rand(10000,99999).time().$_POST['email']);
	$data = ['email' => $_POST['email'], 'code' => $code];
	$id = $db->insert ('temp_log', $data);
	$server = $_SERVER['HTTP_HOST']
	$msg = "Welcome ". $_POST['name']."\n<br>\n<br> Click <a href='$server/proj/activate.php?id=$code&email=".$_POST['email']
			."'>here</a> to activate your account";
	mail($_POST['email'],"Activate your account",$msg);
	$str = ["msg"=>"Mail Sent. Check your mail to activate the account","type"=>1];
}
else {
	$str = ["msg"=>"User can't be Created","type"=>2];
}
echo json_encode($str);
?>