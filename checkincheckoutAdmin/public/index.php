<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif; }
        .container{ height: 100vh;   }
        .wrapper{ width: 360px; padding: 20px;}
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center">
        <div class="wrapper card shadow-5-strong">
            <h2 class="d-flex justify-content-center">Login</h2>
            <form action="../src/check_Login.php" method="post">
                <div class="form-group">
                    <label>Gebruikersnaam</label>
                    <input type="text" name="username" placeholder="Vul een gebruikersnaam in..." <?php if (isset($_GET['error'])) echo 'class="form-control border border-danger"'; ?>  class="form-control">
                    <span class="invalid-feedback"></span>
                </div>    
                <div class="form-group">
                    <label>Wachtwoord</label>
                    <input type="password" name="password" placeholder="Vul een wachtwoord in..." <?php if (isset($_GET['error'])) echo 'class="form-control border border-danger"'; ?> class="form-control">
                    <span class="invalid-feedback"></span>
                </div>
                <?php
                if (isset($_GET['error'])) {
                ?>
                    <p style="color:red;">Inloggevens onjuist!</p>
                <?php
                }
                ?>
                <div class="form-group d-flex justify-content-center ">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
            </form>
        </div>
    </div>
</body>
</html>