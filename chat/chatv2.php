<?php
session_start();
if(!isset($_SESSION["pseudo"]))
{
    header("location:connexion.php");
}
$id = mysqli_connect("127.0.0.1","root","","monchat");
if(isset($_POST["bout"]))
{
    $pseudo =  $_SESSION["pseudo"];
    $message = $_POST["message"];
    $req = "insert into messages values (null,'$pseudo','$message',now())";
    mysqli_query($id, $req);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="chatcss.css">
</head>
<body>
    <div id="container">
        <header>
            <h1>Bonjour <?php echo $_SESSION["pseudo"]?>, Chattez'en direct! Chatbox <a href="deconnexion.php">Deconnexion</a></h1>
        </header>
        <div id="commentaires">
            <ul>
                <?php                
                $req = "select * from messages order by date desc";
                $res = mysqli_query($id, $req);
                while($ligne = mysqli_fetch_assoc($res)){   
                $date = $ligne["date"];
                $pseudo = $ligne["pseudo"];
                $message = $ligne["message"];   
                echo "<li class='message'>$date - $pseudo : $message </li>";                     
                }
                ?>
            </ul>
        </div>
        <div id="formulaire">
            <form action="" method="post">
                <input type="text" name="message" placeholder="Message :" required><br>
                <input type="submit" value="Envoyer" name="bout">
            </form>
        </div>
    </div>
</body>
</html>