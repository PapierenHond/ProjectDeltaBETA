<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="./style/style.css">
<body>
    <div class="background">    </div>
    <div class="container-full">
        <nav class="navbar navbar-dark text-center" style="background-color: #00423c; opacity: 0.8;">
            <div class="w-100">
                <div class="row mt-1">
                    <img src="img/CEMA_logo_borst.png" style="height: 59px; width: 36px" class="ml-4 mr-3">
                    <h1 class="text-light">CEMA Compagnie</h1>
                    <h1 class="text-light ml-auto mr-5" id="clock"></h1>
                </div>
            </div>
        </nav>
        <div class="row justify-content-center vw-100" id="namecard" style="margin: 0;">
      </div>
    </div>
    <script>
    function updateClock() {
      $.ajax({
        url: '../src/clock.php',
        success: function(data) {
          $('#clock').html(data);
        }
      });
    }
    function updateEmployeeList() {
            $.ajax({
            url: '../src/read_employees.php',
            dataType: 'json',
            success: function(data) {
                // Iterate through the data and build the HTML
                var html = '';
                for (var i = 0; i < data.length; i++) {
                // html += '<div> (' + data[i].firstname + ') + " " + (' + data[i].lastname + ')</div>';
                if(data[i].value == 1) {
                    html += '<div class="nameCard mt-2 ml-2 col-2 w-100 row mr-1" id="namecard" style="background-color:red; opacity: 0.9;"><div class="box1 col-10"><h6 class="text-light text-center mt-2">'+ data[i].firstname+" "+data[i].insertion+" "+data[i].lastname +'</h6><h6 class="text-light text-center mt-2">'+data[i].function+'</h6></div><div class="box2 col-2" style="display: flex; align-items: center; justify-content: center;"><h3 class="text-light text-center mt-2">'+data[i].roomnr+'</h3></div></div>';
                } else {
                    html += '<div class="nameCard mt-2 ml-2 col-2 w-100 row mr-1" id="namecard" style="background-color:green; opacity: 0.9;"><div class="box1 col-10"><h6 class="text-light text-center mt-2">'+ data[i].firstname+" "+data[i].insertion+" "+data[i].lastname +'</h6><h6 class="text-light text-center mt-2">'+data[i].function+'</h6></div><div class="box2 col-2" style="display: flex; align-items: center; justify-content: center;"><h3 class="text-light text-center mt-2">'+data[i].roomnr+'</h3></div></div>';
                }
                }

                // Update the HTML of the employee list element
                $('#namecard').html(html);
            }
            });
    }
    updateEmployeeList();
    $(document).ready(function() {
      setInterval(updateClock, 1000);
      setInterval(updateEmployeeList, 1000);
    });
  </script>
</body>
</html>
