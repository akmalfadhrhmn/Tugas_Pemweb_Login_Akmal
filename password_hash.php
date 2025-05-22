<?php

$password_hash = password_hash(password:"12345", algo:PASSWORD_DEFAULT);



echo $password_hash;

?>