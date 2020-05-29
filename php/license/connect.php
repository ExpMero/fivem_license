<?php 
$lic = $_GET['license'];
$name = $_GET['name'];
$ip = get_client_ip();

if (!empty($lic) && !empty($name)){
    include 'db.php';

   // FOR STEP 1 \\ 
   $step = "SELECT * FROM `mine` WHERE `ip` IS NULL AND `lic` = '$lic'";
   $result = mysqli_query($conn, $step);

   // FOR STEP 2 \\ 
   $step2 = "SELECT * FROM `mine` WHERE `ip` = '$ip' AND `lic` = '$lic' AND `name` = '$name'";
   $result2 = mysqli_query($conn, $step2);

   if (mysqli_num_rows($result) > 0) {
       // UPDATE IP \\
       $step3 = "UPDATE `mine` SET `ip`='$ip',`name`='$name' WHERE `lic` = '$lic'";
       mysqli_query($conn, $step3);

    echo 'yes';
   }elseif(mysqli_num_rows($result2) > 0) {
    echo 'yes';
   }else{
    echo 'no';
   }

}

function get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
       $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}
?>