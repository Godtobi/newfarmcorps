<?php
/**
 * Created by PhpStorm.
 * User: MY PC
 * Date: 5/16/2019
 * Time: 8:41 PM
 */
try{
    $db=mysqli_connect("localhost","root","","fc");
}
catch (mysqli_sql_exception $exception){
    $output = 'Unable to connect to the database server: ' . $e;
    echo $output;

}

function sanitize($var)
{
    $clean = htmlspecialchars($var);
    $clean = stripslashes($clean);
    $clean = trim($clean);
    return $clean;

}
if(isset($_REQUEST['send'])) {

    $name = sanitize($_REQUEST['name']);
    $mail = sanitize($_REQUEST['email']);
    $subject = sanitize($_REQUEST['subject']);
    $message = sanitize($_REQUEST['message']);

    if(empty($message)){
        echo "<span class='form-error'> fill the message input</span>";
    }
    elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        echo "<span class='alert-danger form-error'> write a valid email address!</span>";
    }
    else{
        $sql = "INSERT INTO `contact` (`name`,`mail`,`subject`,`message`) VALUES ('$name','$mail','$subject','$message')";
        $sqlquerry = mysqli_query($db, $sql);
        if($sqlquerry){
            echo "<span class='alert-success form-success'> message sent succesfully!</span>";
        }
        else{
            echo "<span class='alert-danger form-error'> 'Oops! Something went wrong. please try again.'</span>";
        }

    }


}

if (isset($_REQUEST['submit'])){

    $mail = mysqli_real_escape_string($db, $_REQUEST['email']);
    if(empty($mail)){
        echo "<span class='alert-danger form-error'> fill in your email!</span>";
    }
    elseif (!filter_var($mail,FILTER_VALIDATE_EMAIL)){
        echo "<span class='alert-danger form-error'> write a valid email address!</span>";
    }
    else{
        $sql="INSERT INTO `news` (`mail`) VALUES ('$mail')";
        $sqlquerry=mysqli_query($db,$sql);
        echo "<span class='form-success alert-success'> subscribed succesfully!</span>";
    }



}