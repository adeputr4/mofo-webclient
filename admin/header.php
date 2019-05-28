
<?php 
  
  session_start();
  require('../helper/api.php');

  if(!$_SESSION['login']){
      header('Location: ../login.php');
  }


  if(isset($_GET['logout']) AND $_GET['logout'] == true){
    session_destroy();
    header('Location: ../');

  }


?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Admin Panel!</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="../index.php">MOFO</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Film <span class="sr-only">(current)</span></a>
      </li>

    </ul>
    <form  class="form-inline my-2 my-lg-0" method="get">
      <input type="hidden" name="logout" value="true">
      <button class="btn btn-danger my-2 my-sm-0" type="submit">Logout</button>
    </form>
  </div>
</nav>

