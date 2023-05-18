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
        if(!isset($_SESSION['language'])){
            $_SESSION['language'] = "EN";
            $styles = 'direction:ltr;text-align:left';
        }elseif($_SESSION['language'] === "EN" || $_SESSION['language'] === "FR"){
            $styles = 'direction:ltr;text-align:left';
        }elseif($_SESSION['language'] === "FA"){
            $styles = 'direction:rtl;text-align:right';
        }
        $this->recipient = $email;
        global $translation;
        $this->subject = $translation['welcome'];
        if($_SESSION['language'] === "EN" || $_SESSION['language'] === "FR"){
            $this->heading = "<p style={$styles} >{$translation['dear']} . ' ' . {$username}, </p>";
        }elseif($_SESSION['language'] === "FA"){
            $this->heading = "<p style={$styles} >{$username} . ' ' . {$translation['dear']}, </p>";
        }
        $this->body1 = "<p style={$styles} >{$translation['welcome']} . {$translation['account_detail']}</p>";
        // I shall continue from here:
        $this->username_text = "<p style=$styles >username: $username</p>";
        $this->password_text = "<p style=$styles >password: $password</p>";
        $this->body2 = "<p style=$styles >If you have not registered into our site, there is no need to further action. However, if this was you, please visit the link below to activate your account:</p>";
        $activation_link = "<p><a href ='https://timingschedule.com/index.php?email=" .$email . '&code=' . $token. "'>https://timingschedule.com/index.php?email=" . $email . '&code=' . $token ."</a></p>";
        $this->footer1 = "<p style=$styles >Yours Sincerely,</p>";
        $this->footer2 = "<p style=$styles >Timing Schedule support team</p>";

        $this->message = $this->heading . $this->body1 . $this->username_text . $this->password_text . $this->body2 . $activation_link . $this->footer1 . $this->footer2;
    }
    function send(){
        $mail_config = new PHPMailer(true);
        try{
            $mail_config->CharSet = 'UTF-8';
            $mail_config->isSMTP();
            $mail_config->Host = "mail.kowsarbaft.ir";
            $mail_config->SMTPAuth = true;
            $mail_config->Username = 'timingschedule@kowsarbaft.ir';
            $mail_config->Password = '09353899182joli1366';
            $mail_config->addAddress($this->recipient);
            $mail_config->Subject = $this->subject;
            $mail_config->Body = $this->message;
            $mail_config->setFrom('timingschedule@kowsarbaft.ir', ' Timing Schedule support team');
            $mail_config->isHTML(true);
            $mail_config->send();
        }catch (Exception $e) {
            echo '<p class="error">There was a problem in sending message.</p>';    
            echo "Mailer Error: {$mail_config->ErrorInfo}";
        }   
    }
}

?>