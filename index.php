<?php
session_start();
$_SESSION['logged'];
$_SESSION['userName'];


if(empty($_SESSION["logged"]))$_SESSION["logged"]=0;
if(empty($_SESSION["userName"]))$_SESSION["userName"]="";

$user = 'root';
$pass ='';
$db = 'nasa_logins'; 

$conn = new mysqli('localhost', $user, $pass, $db) or die("Unable to connect".$conn->connect_error);
//echo "Connected to the database <br>";


function ShowLogin($komunikat=""){
	echo "$komunikat<br><br>";
	echo "<form action='index.php' method=post>";
	echo "Login: <input type='text' name='login'><br>";
	echo "Password: <input type='password' name='haslo'><br><br>";
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
        
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET["wyloguj"])===true){
        $_SESSION["logged"]=0;
        echo "You logged out!";
    };
}

    
if($_SESSION["logged"] ==0){
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(!empty($_POST["login"]) && !empty($_POST["haslo"])){
        $login = htmlspecialchars($_POST["login"]);
        $sql = "select * from nasa_logins.users where user_login = '".htmlspecialchars($_POST["login"])."' AND user_haslo = '".htmlspecialchars($_POST["haslo"])."'";
        $result = $conn->query($sql);
		if($result->num_rows  > 0){
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
		  }    
		}
	else ShowLogin();
  }
 else ShowLogin();   
}
        
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
