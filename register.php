<?php

//polaczenie z baza danych: https://www.w3schools.com/php/php_mysql_insert.asp

$user = 'root';
$pass ='';
$db = 'nasa_logins'; //zalozona w http://localhost/phpmyadmin/server_databases.php?db=

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect".$conn->connect_error);
//echo "Connected to the database <br>";
    

/*
tabela users stworzona w phpmyadmin/sql
polecenie

CREATE TABLE `nasa_logins`.`users` 
( `user_id` INT NOT NULL  NULL AUTO_INCREMENT ,
`user_login` VARCHAR( 256 ),
`user_haslo` VARCHAR( 256 ),
PRIMARY KEY ( `user_id` ) 
) ENGINE = InnoDB;


*/

//testowanie wrzucania do bazy
/*

$sql = "INSERT INTO nasa_logins.users (user_login, user_haslo)
VALUES ('Roman', 'Romanahaslo')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

*/


//testowanie wyciagania z bazy ;
/*
$sql = "SELECT user_haslo FROM nasa_logins.users WHERE user_login ='Roman'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "pass: " . $row["user_haslo"];
    }
} else {
    echo "0 results";
}
$conn->close();

*/

function ShowForm($komunikat=""){	//funkcja wyświetlająca formularz rejestracyjny
	echo "$komunikat<br>";
	echo "<form action='#' method=post>";
	echo "Login: <input type=text name=login><br>";
	echo "Hasło: <input type=password name=haslo><br>";
	echo "<input type=submit value='Zarejestruj mnie'>";
	echo "</form>";
}


?>
<!DOCTYPE html>
<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NASA API Challenge - register</title>
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body id ="register_form">
    <header>
        <div class="title"><a href="subpage.php"><h1>NASA API Challenge</h1></a></div>
    </header>
    <div class = 'greetings'>
    <div class='message'>
    
<?php
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        
        if(strlen(trim($_POST["login"])) >0 && strlen(trim($_POST["haslo"])) >0 ) {
            $login = mysqli_real_escape_string($conn, $_POST["login"]);
            
            $sql = "SELECT * FROM nasa_logins.users WHERE user_login ='".$login."'";
            $result = $conn->query($sql);
            
            if ($result->num_rows  < 1) {
                $pass = mysqli_real_escape_string($conn, $_POST["haslo"]);
                $salted = "98".$pass."iucv";
                $hashed = hash('sha512',$salted);
                
                $sql = "INSERT INTO nasa_logins.users (user_login, user_haslo) VALUES ('$login', '$hashed')";
                
                if ($conn->query($sql) === TRUE) {
                    echo "Rejestracja przebiegła pomyślnie. Możesz teraz przejść do <a href='index.php'>strony głównej</a> i się zalogować.";
            /*
            echo $login;
            echo '<br>';
            echo $pass;
            echo '<br>';
            echo $salted;
            echo '<br>';
            echo $hashed;
            */
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
            
            else {
                ShowForm("Uzytkownik o podanym loginie juz istnieje.");
            }
            
        }
        else {
            ShowForm("Nie uzupełniono wszystkich pol!");
        }
        
    }
    
    else {
        
      ShowForm();  
    };
   
?>
    </div>
</div>

    
</body>
</html>


