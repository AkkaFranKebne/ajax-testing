<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Formularz rejestracyjny</title>
</head>
    <body>
<?php
if($_SESSION["logged"]==0){echo "<h1>nie masz dostępu do tej części witryny.</h1><br> <a href='index.php'>Zaloguj się</a></body></html>;"; exit();}
?>