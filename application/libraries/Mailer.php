<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//require(APPPATH . "/third_party/sendgrid-php/sendgrid-php.php");

class Mailer {
  protected $CI;

  public function __construct(){
    $this->CI =& get_instance();
  }

  
  public function send($content, $subject, $to, $cc = NULL){
    $this->CI->load->library('email');


    $config = array(
      'protocol'  => 'sendmail',
      'smtp_host' => configuracion()["smtp_host"],
      'smtp_port' => configuracion()["smtp_port"],
      'smtp_user' => configuracion()["smtp_user"],
      'smtp_pass' => configuracion()["smtp_pass"],
      'mailtype'  => 'html',
      'charset'   => 'utf-8',
      'wordwrap' => TRUE,
  );

    $this->CI->email->initialize($config);
    $this->CI->email->set_mailtype("html");
    $this->CI->email->set_newline("\r\n");

    $this->CI->email->to($to);
    if($cc){
        $this->CI->email->cc($cc);
    }
    $this->CI->email->from(configuracion()["smtp_user"],'IntegraTic');
    $this->CI->email->subject($subject);
    $this->CI->email->message($content);

    try {
      //Send email

      if ($this->CI->email->send()) {
        return true;
      } else {
        die($this->CI->email->print_debugger());
          //Do whatever you want if failed 
          return false;
      }
    } catch (Exception $e) {
      return false;
      //echo $e->getMessage();
    }
  }
}