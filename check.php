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
if($_SESSION["zalogowany"]==0){echo "nie masz dostępu do tej części witryny. <a href='index.php'>Zaloguj się</a></body></html>;"; exit();}
?>