<?php
  //Step 1. get database connection
  require('../config/database.php');
  //Step 2. get form-data

  $e_mail = trim($_POST['email']);
  $p_wd = trim($_POST['passwd']);
  
  //$enc_pass = password_hash($p_wd, PASSWORD_DEFAULT);
  $enc_pass = md5($p_wd);

  //Step 3 Query Validation

  $sql_check_user = "
    select 
	    u.email,
	    u.password
    from 
	    users  u
    where 
	    u.email = '$e_mail'
	    and u.password = '$enc_pass'
    limit 1
  ";
  //Step 4
  $res_check = pg_query($conn_supa, $sql_check_user);
  if (pg_num_rows($res_check) > 0){
    echo "User exists. Go to main !!!";+
    header('refresh:0;url=main.php'); 
  } else {
    echo "Verify data";
  }