
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Ćwiczenie 2</title>
</head>
<body>

<!---formularz przeniesiony do php
    
    <form action="mailSender.php" method = "POST">
        <label>Imię odbiorcy:<br> <input type="text" name = "userName"></label><br>
        <label>Nazwisko odbiorcy:<br> <input type="text" name = "userSurname"></label><br>
        <label>E-mail odbiorcy:<br> <input type="email" name = "userEmail"></label><br>
        <label>Temat wiadomosci: <br><input type="text" name = "topic"></label><br>
        Treśc wiadomosci:<br>
        <textarea type="text" name = "message"></textarea><br>
        <br>
        <input type="submit" value ="Wyślij"></input>
    </form>
-->

</body>
</html>

<?php

if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['message']) === true) {

  if (urldecode($_GET['message']) === "Message has been sent.") {
    echo '<div style="color: green; font-size: 26px;">' . urldecode($_GET['message']) . '</div>' ;
  } else {
    echo '<div style="color: red; font-size: 26px;">' . urldecode($_GET['message']) . '</div>' ;
  }

} else {
echo '
    <form action="mailSender.php" method = "POST">
        <label>Imię odbiorcy:<br> <input type="text" name = "userName"></label><br>
        <label>Nazwisko odbiorcy:<br> <input type="text" name = "userSurname"></label><br>
        <label>E-mail odbiorcy:<br> <input type="email" name = "userEmail"></label><br>
        <label>Temat wiadomosci: <br><input type="text" name = "topic"></label><br>
        Treśc wiadomosci:<br>
        <textarea type="text" name = "message"></textarea><br>
        <br>
        <input type="submit" value ="Wyślij"></input>
    </form>
';
}


 //phpinfo();

?>
