<?php 
$server = "localhost";
$user="root";
$pass ="";
$database="login form"; 

$conn=mysqli_connect($server,$user,$pass,$database );


if(isSet($_POST['register'])){
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $role=mysqli_real_escape_string($conn,$_POST["role"]);
    $pass=mysqli_real_escape_string($conn,$_POST["password"]);
    $p=password_hash($pass, PASSWORD_DEFAULT);

   
   $Q="INSERT INTO person(email,role,PASSWORD)VALUES('$email','$role','$p')";
   
   If(mysqli_query($conn,$Q)){
     header("location:login.php");

}
}

session_start();

if(isSet($_POST['send'])){
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $pass=mysqli_real_escape_string($conn,$_POST["password"]);
    $p=password_hash($pass, PASSWORD_DEFAULT);

   
   $Q="SELECT * FROM person WHERE email='$email'";
   
   $r=mysqli_query($conn,$Q);
   if(mysqli_num_rows($r) > 0){
    $u=mysqli_fetch_assoc($r);

    if(password_verify($pass,$u['PASSWORD'])){
      $_SESSION['email']=$u['email'];
      $_SESSION['pass']=$u['PASSWORD'];
      $_SESSION['role']=$u['role'];
      
      if ($u['role']=="admin"){
        header("location:admin.php");
      }
      else{
           header("location:userdashboard.php");
      }
      // echo "Logged in";
    }
   
    else{
      echo "Incorrect password";
    }
     }
     else{
      echo "You have no account";
     }
   
   }
?>