
<?php
$URL_ATUAL= "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//$result = file_get_contents($URL_ATUAL); 

$respGet = (object) filter_input_array(INPUT_GET, FILTER_DEFAULT);

echo "<pre>";
print_r($respGet);
echo "<pre>";
echo json_encode($respGet);

?>
