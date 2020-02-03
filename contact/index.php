<?php

require_once "../form/contact_config.php";
require_once "../form/form.php";


function confirm($form_data){
  $errors = array();

  if(!$form_data["name"]){
    $errors["name"] = "no name";
  }

  if(!$form_data["message"]){
    $errors["message"] = "no message";
  }

  if(!$form_data["email"]){
    $errors["email"] = "no email";
  }else if(!preg_match("/.+@.+$/", $form_data["email"])){
    $errors["email"] = "invalid email";
  }

  return $errors;
}

function has_value($array){
  $return = false;
  foreach($array as $val){
    if($val){
      $return = true;
    }
  }
  return $return;
}

function map($form_data){
  $time = time();

  $map = array(
    "%name%" => $form_data["name"],
    "%email%" => $form_data["email"],
    "%message%" => $form_data["message"],
  );
  return $map;
}

