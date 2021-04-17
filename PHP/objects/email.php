<?php
    
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class Send_email{
    public $recipient;
    public $subject;
    public $heading;
    public $body1;
    public $body2;
    public $body3;
    public $username_text;
    public $password_text;
    public $footer1;
    public $footer2;
    public $message;

    function email_activation_message_generator($email, $username, $password, $token){
        $this->recipient = $email;
        $this->subject = "Welcome to Timing Schedule";
        $this->heading = "<p style='direction:ltr;text-align:left'>Dear $username, </p>";
        $this->body1 = "<p style='direction:ltr;text-align:left'>Welcome to Timing Schedule. Your account detail is as follows:</p>";
        $this->username_text = "<p style='direction:ltr;text-align:left'>username: $username</p>";
        $this->password_text = "<p style='direction:rtl;text-align:left'>password: $password</p>";
        $this->body2 = "<p style='direction:ltr;text-align:left'>If you have not registered into our site, there is no need to further action. However, if this was you, please visit the link below to activate your account:</p>";
        $activation_link = "<p><a href ='https://timingschedule.com/index.php?email=" .$email . '&code=' . $token. "'>https://timingschedule.com/index.php?email=" . $email . '&code=' . $token ."</a></p>";
        $this->footer1 = "<p style='direction:ltr;text-align:left'>Yours Sincerely,</p>";
        $this->footer2 = "<p style='direction:ltr;text-align:left'>Timing Schedule support team</p>";

        $this->message = $this->heading . $this->body1 . $this->username_text . $this->password_text . $this->body2 . $activation_link . $this->footer1 . $this->footer2;
    }
    function send(){
        $mail_config = new PHPMailer(true);
        try{
            $mail_config->CharSet = 'UTF-8';
            $mail_config->isSMTP();
            $mail_config->Host = "mail.diorhome.ir";
            $mail_config->SMTPAuth = true;
            $mail_config->Username = 'info@diorhome.ir';
            $mail_config->Password = 'joli1366';
            $mail_config->addAddress($this->recipient);
            $mail_config->Subject = $this->subject;
            $mail_config->Body = $this->message;
            $mail_config->setFrom('support@timingschedule.com', ' Timing Schedule support team');
            $mail_config->isHTML(true);
            $mail_config->send();
        }catch (Exception $e) {
            echo '<p class="error">There was a problem in sending message.</p>';    
            echo "Mailer Error: {$mail_config->ErrorInfo}";
        }   
    }
}

?>