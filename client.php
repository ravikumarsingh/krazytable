<?php
	
$data[] = array('username'=>"ravi007virus@gmail.com",'password'=>"ravi11");
$data_string = json_encode($data);
echo $data_string;
$ch = curl_init('http://krazytable.com/modules/login.php');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
);

$result = curl_exec($ch);
echo $result;
$result1 = json_decode($result);
print_r($result1);
echo $result1->status;
echo $result1->description;

?>