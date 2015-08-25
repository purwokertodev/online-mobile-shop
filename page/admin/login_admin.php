<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Bumiayu Cell: Login Petugas</title>

    <!-- Bootstrap core CSS -->
    <link href="../../styles/bootstrap/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../../styles/signin/signin.css" rel="stylesheet">
    
  </head>

  <body>

    <div class="container">

        <form action="login_admin_finish.php" method="post" class="form-signin">
        <h2 class="form-signin-heading">Silahkan login</h2>
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <label class="checkbox">
          <input type="checkbox" value="remember-me"> Ingat saya
        </label>
        <button class="btn btn-lg btn-success btn-block" type="submit" name="Login">Login</button>
      </form>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>
