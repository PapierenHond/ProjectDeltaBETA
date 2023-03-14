<!DOCTYPE html>
<html lang="en">
<?php 
include ('head.php');
include ('../src/functions/crud_employee.php');
if (isset($_GET['method'])) {
  if ($_GET['method'] == "control") {
    $id = $_GET['id'];
    $result = readEmployee($id);
  }
  if ($_GET['method'] == "delete") {
    $id = $_GET['id'];
    $result = readEmployee($id);
    $deleteNotification = TRUE;
  }
} 
?>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100" style="background-color: white;">
        <nav class="navbar text-center mb-5" style="background-color: #00423c; margin:0;">
            <div class="w-100">
                <div class="row mt-1">
                    <img src="img/CEMA_logo_borst.png" class="ml-4 mr-3">
                    <h1 class="text-light">CEMA Compagnie</h1>
                </div>
            </div>
        </nav>
          <div class="row d-flex justify-content-center align-items-center h-85">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <?php if(isset($_GET['method']) == "control") {?>
              <form class="card shadow-2-strong" class="col-4" style="border-radius: 1rem;" action="../src/employee.php?method=update&id=<?php echo $result[0]?>" method="POST">
            <?php } else {?>
              <form class="card shadow-2-strong" style="border-radius: 1rem;" action="../src/employee.php?method=create" method="POST">
            <?php }?>
                  <div class="card-header">Medewerkers beheer</div>
                  <div class="card-body p-5 text-center">
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="firstname" placeholder="Voornaam" value="<?php if (isset($_GET['method']) == "control") { echo $result[1]; }?>" required>
                    </div>
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="insertion" placeholder="Tussenvoegsel" value="<?php if (isset($_GET['method']) == "control") { echo $result[2]; }?>">
                    </div>
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="lastname" placeholder="Achternaam" value="<?php if (isset($_GET['method']) == "control") { echo $result[3]; }?>" required>
                    </div>
                    <div class="form-outline mb-2">
                      <input type="date" class="form-control form-control-lg" name="birthday" placeholder="Geboortedatum" value="<?php if (isset($_GET['method']) == "control") { echo $result[4]; }?>" required>
                    </div>
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="function" placeholder="Functie" value="<?php if (isset($_GET['method']) == "control") { echo $result[5]; }?>" required>
                    </div>
                    <div class="form-outline mb-2">
                      <input type="text" class="form-control form-control-lg" name="room_number" placeholder="Kamer nummer" value="<?php if (isset($_GET['method']) == "control") { echo $result[7]; }?>" required>
                    </div>
                    <div class="form-outline mb-4">
                    <?php if (isset($_GET['method']) == "control") { ?>
                      <select class="form-control" aria-label="Default select example" name="nfc_id" required>
                      <option value="<?php echo $result[8]?>" selected="selected"><?php echo $result[8];?> HUIDIGE</option>
                                <?php foreach(getAllUnasignedUID() as $unasignedUid) {?>
                                <option value="<?php echo $unasignedUid['NFC_ID']?>"><?php echo $unasignedUid['NFC_ID']?></option>
                                <?php } ?>
                        </select>
                    <?php } else {?>
                      <select class="form-control" aria-label="Default select example" name="nfc_id" required>
                                <?php foreach(getAllUnasignedUID() as $unasignedUid) {?>
                                <option value="<?php echo $unasignedUid['NFC_ID']?>"><?php echo $unasignedUid['NFC_ID']; echo " | "; echo $unasignedUid['Created_At']?></option>
                                <?php } ?>
                        </select>
                    <?php }?>
                      </div>
                    <?php if (isset($_GET['method']) == "control") {?>
                        </form>
                          <button class="btn btn-success btn-lg btn-block" type="submit">Update</button>
                        </form>
                        <form class="mb-1 mt-1" class="col-4" action="control_panel_employees.php?method=delete&id=<?php echo $result[0]?>" method="POST">
                          <button class="btn btn-danger btn-lg btn-block" type="submit">Delete</button>
                        </form>
                        <form class="mb-1" class="col-4" action="control_panel_employees.php" method="POST">
                          <button class="btn btn-warning btn-lg btn-block text-light" type="submit">Annuleer</button>
                        </form>
                    <?php } else {?>
                      <button class="btn btn-primary btn-lg btn-block" type="submit">Aanmaken</button>
                    <?php } ?>
                  </div>
            </form>
          </div>
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
          <?php if (isset($deleteNotification)) {?>
              <div class="row alert alert-danger d-flex justify-content-center" role="alert">
                  <p class="col-12 text-center">Weet u zeker dat u <?php echo $result[1]; echo " "; echo $result[2]; echo " "; echo $result[3];?> wilt verwijderen?</p>
                  <form action="../src/employee.php?method=delete&id=<?php echo $result[0];?>" class="d-flex justify-content-end" style="width: 50%;" method="POST">
                    <button class="btn btn-success col-12 mr-1" type="submit">Ja</button>
                  </form>
                  <form action="control_panel_employees.php?method=control&id=<?php echo $result[0];?>" style="width: 50%;" method="POST">
                    <button class="btn btn-danger col-12" type="submit">Nee</button>
                  </form>
              </div>
            <?php } ?>
            <a class="btn btn-primary display w-100 mb-3" href="control_panel_users.php"><b>Naar admin beheer</b></a>
            <a class="btn btn-info display w-100 mb-3" href="../src/logout.php"><b>Uitloggen</b></a>
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
              <div class="card-body p-5 text-center" style="max-height: 53vh; overflow: auto;">
                <?php foreach(readAllEmployees() as $Employee) {?>
                <form class="mb-1" style="border-radius: 1rem;" action="control_panel_employees.php?method=control&id=<?php echo $Employee['ID'];?>" method="POST">
                    <button class="btn text-light button" style="width: 100%; background-color: #00423c; opacity: 0.9;" type="submit"><?php echo $Employee['Firstname']; echo " "; echo $Employee['Insertion']; echo " "; echo $Employee['Lastname'];?></button>
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
