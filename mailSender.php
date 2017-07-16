<?php

//testowa wysylka maila
/*
require 'PHPMailerAutoload.php';

$mail = new PHPMailer;

$mail->setFrom('ewa.wrobel@gmail.com', 'Your Name');
$mail->addAddress('ewa.wrobel@gmail.com', 'My Friend');
$mail->Subject  = 'First PHPMailer Message';
$mail->Body     = 'Hi! This is my first e-mail sent through PHPMailer.';
if(!$mail->send()) {
  echo 'Message was not sent.';
  echo 'Mailer error: ' . $mail->ErrorInfo;
} else {
  echo 'Message has been sent.';
}
*/

?>


<?php

//skorzystaj z biblioteki
require 'PHPMailerAutoload.php';

//zdefiniuj email i nazwe admina
define('ADMIN_NAME', "Admin");
define('ADMIN_MAIL', "wp_1@lokori.atthouse.pl");

//sprawdz, czy dane przyszly metoda post i przypisz je do zmiennych
if($_SERVER['REQUEST_METHOD'] === 'POST') {
  if(
      (isset($_POST['userName']) === true)
  && (isset($_POST['userSurname']) === true)
  && (isset($_POST['userEmail']) === true) 
  && (isset($_POST['topic']) === true) 
  && (isset($_POST['message']) === true)
  ) {
      $userName = $_POST['userName'];
      $userEmail = $_POST['userEmail'];
      $topic = $_POST['topic'];
      $message = $_POST['message'];
    
      //uruchomienie bilioteki
      $mail = new PHPMailer;
      
      //dodane: paremetry maila do wysylki
      
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host = 'lokori.atthouse.pl';  // Specify main and backup SMTP servers
        $mail->SMTPAuth = true;                               // Enable SMTP authentication
        $mail->Username = 'wp_1@lokori.atthouse.pl';                 // SMTP username
        $mail->Password = 'Nc6DPQCI0O#m3';                           // SMTP password
        $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465;                                    // TCP port to connect to
      

    //wyslij maila  
      
        $mail->setFrom (ADMIN_MAIL, ADMIN_NAME) ;
        $mail->addAddress($userEmail, $userName);
        $mail->Subject  = $topic;
        $mail->Body     = $message;
    
      //przekieruj na strone z komunikatem, odpowiednio go kodujac
      
     if($mail->send()) {
        $message = urlencode("Message has been sent.");
    } 
      else {
        $message = urlencode("Message was not sent.");
    }
    header("Location: contactForm.php?message=$message");

}
    
}

?>

echo 'Mailer error: ' . $mail->ErrorInfo;