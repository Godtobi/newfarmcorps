<?php
/**
 * Created by PhpStorm.
 * User: USER
 * Date: 3/25/2019
 * Time: 9:51 AM
 */


try{
    $pdo = new PDO('mysql:host=localhost;dbname=launch', 'root', '');
}
catch(PDOException $e){
    $output = 'Unable to connect to the database server: ' . $e;
}





if(isset($_POST['con'])){

    $email=$_POST['email'];
    $name=$_POST['name'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    try {


        $pdoquery = "INSERT INTO `contact` (`email`,`name`,`subject`,`message`)VALUES (:email,:name,:subject,:message)";
        $pdoresult = $pdo->prepare($pdoquery);
        $pdoExec = $pdoresult->execute(array(":email" => $email, ":name" => $name, ":subject" => $subject, ":message" => $message));

        echo "<script type='text/javascript'> alert('your message has been sent. Thank You!'); window.location.href='contact.html';</script>";
    }
    catch (PDOException $exception){
        echo "<script type='text/javascript'> alert('your message wasnt sent. kindly try again!'); window.location.href='contact.html';</script>";
    }

}



if(isset($_POST['submit'])){
    $email=$_POST['email'];
    try{

        $pdoquery = "INSERT INTO `mail` (`email`)VALUES (:email)";
        $pdoresult = $pdo->prepare($pdoquery);
        $pdoExec = $pdoresult->execute(array(":email" => $email));
        echo "<script type='text/javascript'> alert(' email saved. we cant wait to notify you'); window.location.href='index.html';</script>";
    }

    catch (PDOException $exception){
        echo "<script type='text/javascript'> alert(' email  wasn saved. '); window.location.href='index.html';</script>";
    }

}
