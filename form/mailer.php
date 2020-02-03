<?php

require_once "qdmail.php";

class Mailer{
  function Mailer($from, $name, $title){
    $this->qdmail = new Qdmail("UTF-8", "base64");
    //$this->qdmail->errorDisplay(false);
    //$this->qdmail->messageIdRight("")

    $this->from = $from;
    $this->name = $name;
    $this->title = $title;
    $this->body = "";
    $this->attach = array();
  }

  function send($to){
    $this->qdmail->text($this->body);
    $this->qdmail->to($to, "");
    $this->qdmail->subject($this->title);
    $this->qdmail->from($this->from, $this->name);
    if($this->attach) $this->qdmail->attach($this->attach);
    $this->qdmail->mtaOption("-f {$this->from}");
    $this->qdmail->send();
  }
}