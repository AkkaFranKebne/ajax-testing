<?php
//sesja
session_start();
$_SESSION['logged'];
$_SESSION['userName'];


if(empty($_SESSION["logged"]))$_SESSION["logged"]=0;
if(empty($_SESSION["userName"]))$_SESSION["userName"]="";

//baza sql
$user = 'root';
$pass ='';
$db = 'nasa_logins'; 

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect".$conn->connect_error);
//echo "Connected to the database <br>";

//funkcja wyswietlajaca formularz
function ShowLogin($komunikat=""){
	echo "$komunikat<br><br>";
	echo "<form action='index.php' method=post>";
	echo "Login: <input type='text' name='login'"; 
    //autouzupelnianie imienia po cookie
    if(isset($_COOKIE['rememberLogin'])) {
        echo "value='{$_COOKIE['rememberLogin']}'><br>";
            }
    else {
        echo "value='blabla'><br>";
    }
    

	echo "Password: <input type='password' name='haslo'><br>";
    echo "<input type='checkbox' name ='remember' id = 'remember'> Remember me<br>";
	echo "<input type='submit' value='Log in'>";
	echo "</form>";
	echo "<br><br><p class='findForm'>Register <a href='register.php'> here</a></p>";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NASA API Challenge</title>
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/app.js"></script>
    <link rel="stylesheet" href="css/main.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>
<body class="loading">
    <header>
        <div class="title"><a href="subpage.php"><h1>NASA API Challenge</h1></a></div>
        <div class = "greetings">    
        <div class='message'>
        
        
    <?php
 //komunikat po wylogowaniu   = skonczeniu sesji    
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET["wyloguj"])===true){
        $_SESSION["logged"]=0;
        echo "You logged out!";
    };
}

//zalogowanie oparte na sesji    
if($_SESSION["logged"] ==0){
    //jesli uzytkownik loguje sie bedac na stronie
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      //jesli uzytkownik podal login i haslo
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
        $login = mysqli_real_escape_string($conn, $_POST["login"]);
        $pass = mysqli_real_escape_string($conn, $_POST["haslo"]);
        $salted = "98".$pass."iucv";
        $hashed = hash('sha512',$salted);
        
        $sql = "select * from nasa_logins.users where user_login = '$login' AND user_haslo = '$hashed'";
        
        $result = $conn->query($sql);
        //jesli login i haslo sa w bazie
		if($result->num_rows  > 0){
            //sprawdzenie, czy zaznaczyl zapamietaj mnie, ustawienie miesiecznego cookie
            if (!empty($_POST['remember'])){
                setcookie("rememberLogin", $login, time()+2592000);
            }
            //wyswietlenie komunikatu
            while($row = $result->fetch_assoc()) {
                echo "<p class='welcome' >Hello ". $row["user_login"]. "! </p>"  ;
                echo "<p class='welcome'><a href='index.php?wyloguj=tak'>Log out</a></p>";
            }
			$_SESSION["logged"]=1;
			$_SESSION["userName"]=$login;
            //echo $_SESSION["userName"];
			}
		else {
		    echo ShowLogin("No match!");
             echo $login;
            echo '<br>';
            echo $pass;
            echo '<br>';
            echo $salted;
            echo '<br>';
            echo $hashed;
		  }    
		}
	else ShowLogin();
  }
 else ShowLogin();   
}
 //jesli uzytkownik jest juz zalogowany wchodzac na strone       
else if ($_SESSION["logged"] ==1) {

echo "<p class='welcome' >Hello ". $_SESSION["userName"]. "!</p>";
echo "<p class='welcome'><a href='index.php?wyloguj=tak'>Log out</a></p>";

    } 
             

?>
    </div> 
        </div>
        <div class="login"><a href="#"><p>Login</p></a></div>            
    </header>
    
    <section id='introduction'>
    </section>
    <section id='gallery'>
        <h1>Photos from Mars</h1>
        <div class='container'>
             <picture><img  src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img   src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  src="#" alt="Mars" height="300px" width='400px'></picture> 
             <picture><img  class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img   class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture>
            <picture><img  class='invisible' src="#" alt="Mars" height="300px" width='400px'></picture> 
        </div>
        <button>LOAD MORE</button>

      
    </section>


</body>
</html>
