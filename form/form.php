<?php

@session_start();
date_default_timezone_set('Asia/Tokyo');

if($_SERVER["REQUEST_METHOD"] === "GET"){
  $token = generate_token();
  $_SESSION["token"] = $token;

  require_once "./view/input.php";
}else if(isset($_POST["action"]) && isset($_POST["token"]) && validate_token($_POST["token"])){
  $form_data = form_data();
  $token = $_POST["token"];

  switch($_POST["action"]){
  case "back":
    require_once "./view/input.php";
    break;
  case "confirm":
    $errors = confirm($form_data);
    if(empty($errors)){
      $form_data = form_data("");
      require_once "./view/confirm.php";
    }else{
      require_once "./view/input.php";
    }
    break;
  case "send":
    $errors = confirm($form_data);
    if(empty($errors) && send($form_data)){
      unset($_SESSION["token"]);
      header("Location: ".$_SERVER['REQUEST_URI']."thanks/");
      exit;
    }else{
      require_once "./view/input.php";
    }
    break;
  }
}else{
  $token = generate_token();
  $_SESSION["token"] = $token;
  require_once "./view/input.php";
}

function h($str){
  return htmlspecialchars($str);
}

function show($value,$f){
  if(isset($f) && $f && $f[$value]){
    echo h($f[$value]);
  }
}

function generate_token(){
  return hash('sha256', session_id() . time());
}

function validate_token($token){
  if(isset($_SESSION["token"])){
    return $token === $_SESSION["token"];
  }
  return false;
}

function element($array, $key, $default=false){
  return isset($array[$key]) && $array[$key] ? $array[$key] : $default;
}

function form_data($default=false){
  $form_data = array();
  foreach(explode(",", FORM_ELEMENTS) as $key){
    $form_data[$key] = element($_POST, $key, $default);
  }
  return $form_data;
}

function pre($e){
  echo "<pre>";
  print_r($e);
  echo "</pre>";
}

function send($form_data){
  require_once "mailer.php";
  $form_data = form_data("");

  /* to ADMIN */
  _send($form_data, MAIL_ADMIN, MAIL_ADMIN_TITLE, MAIL_ADMIN_BODY);

  /* to USER */
  _send($form_data, $form_data["email"], MAIL_TITLE, MAIL_BODY);

  return true;
}

function _send($form_data,$to,$title,$mail_body){
  $from = MAIL_FROM;
  $name = MAIL_NAME;
  $body = "";
  $file = fopen($mail_body, "r");
  while(!feof($file)){
    $str = fgets($file);
    $body .= $str;
  }
  fclose($file);
  foreach(map($form_data) as $key => $val){
    $body = str_replace($key, $val, $body);
  }
  $mailer = new Mailer($to, $name, $title);
  $mailer->body = $body;

  foreach(explode(",", $to) as $_to){
    $mailer->send($_to);
  }

}

