<!DOCTYPE html>
<html lang="en">
<?php 
include ('head.php');
include ('../src/functions/crud_user.php');
if (isset($_GET['method'])) {
  if ($_GET['method'] == "control") {
    $id = $_GET['id'];
    $result = readusers($id);
  }
  if ($_GET['method'] == "delete") {
    $id = $_GET['id'];
    $result = readusers($id);
    $deleteNotification = TRUE;
  }
}
if (isset($_GET['error'])) {
  if ($_GET['error'] == "delete") {
    $deleteError = true;
  }
  if ($_GET['error'] == "password") {
    $passwordError = true;
  }
}
?>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
        <nav class="navbar text-center mb-5" style="background-color: #00423c; max-height: 10vh; margin:0;">
            <div class="w-100">
                <div class="row mt-1">
                    <img src="img/CEMA_logo_borst.png" class="ml-4 mr-3">
                    <h1 class="text-light">CEMA Compagnie</h1>
                </div>
            </div>
        </nav>
          <div class="row d-flex justify-content-center align-items-center h-90">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <?php if(isset($_GET['method']) == "control") {?>
              <form class="card shadow-2-strong" style="border-radius: 1rem;" action="../src/users.php?method=update&id=<?php echo $result[0]?>" method="POST">
            <?php } else {?>
              <form class="card shadow-2-strong" style="border-radius: 1rem;" action="../src/users.php?method=create" method="POST">
            <?php }?>
                  <div class="card-header">Admin beheer</div>
                  <div class="card-body p-5 text-center">
                    <div class="form-outline mb-4">
                      <input type="text" class="form-control form-control-lg" name="username" placeholder="Gebruikersnaam" value="<?php if (isset($_GET['method']) == "control") { echo $result[1]; }?>" required>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" value="<?php if (isset($_GET['method']) == "control") { echo $result[2]; }?>" required>
                    </div>
                    <div class="form-outline mb-4">
                      <input type="password" class="form-control form-control-lg" name="passwordrepeat" placeholder="Password Repeat" value="<?php if (isset($_GET['method']) == "control") { echo $result[2]; }?>" required>
                    </div>
                    <?php if (isset($_GET['method']) == "control") {?>
                    </form>
                        <button class="btn btn-success btn-lg btn-block" type="submit">Update</button>
                      </form>
                      <form class="mb-1 mt-1" action="control_panel_users.php?method=delete&id=<?php echo $result[0]?>" method="POST">
                        <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
                      </form>
                      <form class="mb-1" action="control_panel_users.php" method="POST">
                        <button class="btn btn-warning btn-lg btn-block text-light" type="submit">Annuleer</button>
                      </form>
                    <?php } else {?>
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Aanmaken</button>
                    <?php }?>
                  </div>
            </form>
          </div>
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <?php if (isset($deleteNotification)) {?>
              <div class="row alert alert-danger d-flex justify-content-center" role="alert">
                  <p class="col-12 text-center">Weet u zeker dat u <?php echo $result[1]; echo " ";?> wilt verwijderen?</p>
                  <form action="../src/users.php?method=delete&id=<?php echo $result[0];?>" class="d-flex justify-content-end" style="width: 50%;" method="POST">
                    <button class="btn btn-success col-12 mr-1" type="submit">Ja</button>
                  </form>
                  <form action="control_panel_users.php?method=control&id=<?php echo $result[0];?>" style="width: 50%;" method="POST">
                    <button class="btn btn-danger col-12" type="submit">Nee</button>
                  </form>
              </div>
            <?php } ?>
          <?php if (isset($passwordError)) {?>
              <div class="row alert alert-danger d-flex justify-content-center" role="alert">
                  <p class="col-12 text-center">Wachtwoorden komen niet overeen!</p>
                  <form action="control_panel_users.php" style="width: 50%;" method="POST">
                    <button class="btn btn-success col-12" type="submit">Begrepen</button>
                  </form>
              </div>
            <?php } ?>
            <?php if (isset($deleteError)) {?>
              <div class="row alert alert-danger d-flex justify-content-center" role="alert">
                  <p class="col-12 text-center">Deze gebruiker kan niet verwijderd worden. er moet minimaal 1 admin account overblijven.</p>
                  <form action="control_panel_users.php" style="width: 50%;" method="POST">
                    <button class="btn btn-danger col-12" type="submit">Begrepen</button>
                  </form>
              </div>
            <?php } ?>
          <a class="btn btn-primary display w-100 mb-3" href="control_panel_employees.php"><b>Naar medewerkers beheer</b></a>
          <a class="btn btn-info display w-100 mb-3" href="../src/logout.php"><b>Uitloggen</b></a>
          <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center" style="max-height: 53vh; overflow: auto;">
                <?php foreach(readAllusers() as $users) {?>
                  <form class="mb-1" style="border-radius: 1rem;" action="control_panel_users.php?method=control&id=<?php echo $users['ID'];?>" method="POST">
                    <button class="btn text-light button" style="width: 100%; background-color: #00423c; opacity: 0.9;" type="submit"><?php echo $users['Username'];?></button>
                </form>
                <?php }?>
              </div>
            </div>
          </div>
          </div>
        </div>
      </section>
</body>
</html>
