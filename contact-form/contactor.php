<?php

require_once 'autoload.php';
require_once 'SimpleMail.class.php';
require_once 'Config.class.php';

$helperLoader = new SplClassLoader('Helpers');
$mailLoader   = new SplClassLoader('SimpleMail');

$helperLoader->register();
$mailLoader->register();

use Helpers\Config;
use SimpleMail\SimpleMail;

$config = new Config;

$config->load('config.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	
        if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])) {
            $secret = 'google-secret';
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
            $responseData = json_decode($verifyResponse);
        }
	
        $name    = stripslashes(trim($_POST['form-name']));
        $email   = stripslashes(trim($_POST['form-email']));
        $message = stripslashes(trim($_POST['form-message']));
        $subject = "Website";
    
        $pattern = '/[\r\n]|Content-Type:|Bcc:|Cc:/i';

        if (preg_match($pattern, $name) || preg_match($pattern, $email)) {
            die("Header injection detected");
        }

        $emailIsValid = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($name && $email && $emailIsValid && $message && $responseData->success) {
                        
            $mail = new SimpleMail();
            $mail->setTo($config->get("emails.to"));
            $mail->setFrom($config->get('emails.from'));
            $mail->setReplyTo($email);
            $mail->setSender($name);
            $mail->setSubject($subject);

            $body = "
                <!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd\">
                <html>
                    <head>
                        <meta charset=\"utf-8\">
                    </head>
                    <body>
                        <h2>Website Message</h2>
                        <p><strong>{$config->get('fields.name')}:</strong> {$name}</p>
                        <p><strong>{$config->get('fields.email')}:</strong> {$email}</p>
                        <p><strong>{$config->get('fields.message')}:</strong></p>
                        <p>{$message}</p>
                    </body>
                </html>";

                $mail->setHtml($body);
                
                $mail->send();
                $emailSent = true;
    
        } else {
            $hasError = true;
        }
        
    } 
	
	if($emailSent == true) { ?>
        
        <h2>Message sent!</h2>
		<section><? echo $config->get('messages.success'); ?></section>
    
    <?php } else { ?>
    
            <?php if(!empty($hasError)) { ?>

            <h2>Yikes!</h2>
            <section><?php echo $config->get('messages.error'); ?></section>
            
    <?php 
            }
        } 
    if ($emailSent == false && $hasError == false) {
    ?>

	    <h2>Contact me</h2>
	    
	    <section>
	    
            <form action="<? echo parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH); ?>" enctype="application/x-www-form-urlencoded" id="contact-form" method="post">

            <input type="text" class="form-control" id="form-name" name="form-name" placeholder="<?php echo $config->get('fields.name'); ?>" required>
            
            <input type="email" class="form-control" id="form-email" name="form-email" placeholder="<?php echo $config->get('fields.email'); ?>" required>
                
            <textarea class="expanding" id="form-message" name="form-message" placeholder="<? echo $config->get('fields.message'); ?>" required></textarea>
            
            <div class="g-recaptcha" data-sitekey="public-key"></div> 
            
            <button type="submit" class="btn">
                <?php echo $config->get('fields.btn-send'); ?>
            </button>
                
            </form>
	    </section>
    <? } ?>