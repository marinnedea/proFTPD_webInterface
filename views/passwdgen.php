<?php 

function generate_password($length = 8, $complex = 4) {
$min = "abcdefghjkmnpqrstuvwxyz";
$num = "23456789";
$maj = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$symb = "!@#$%^&*_=?";
$chars = $min;
if ($complex >= 2) { $chars .= $num; }
if ($complex >= 3) { $chars .= $maj; }
if ($complex >= 4) { $chars .= $symb; }
$password = substr( str_shuffle( $chars ), 0, $length );
return $password;
}

echo generate_password(8);

?>
