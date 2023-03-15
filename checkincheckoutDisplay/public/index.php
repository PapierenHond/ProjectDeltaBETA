<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="./style/style.css">
<body>
  <div class="background"></div>
    <div class="container-full w-100 mw-100">
        <nav class="navbar navbar-dark text-center" style="background-color: #00423c; opacity: 0.8;">
            <div>
                <div class="row mt-1">
                    <img src="img/CEMA_logo_borst.png" style="height: 59px; width: 36px" class="ml-4 mr-3">
                    <h1 class="text-light">CEMA Compagnie</h1>
                    <h1 class="text-light ml-auto mr-5" id="clock"></h1>
                </div>
            </div>
        </nav>
        <div class="row justify-content-center pl-4 pr-5" id="namecards"></div>
    </div>
    <script>
    // function updateClock() {
    //   $.ajax({
    //     url: '../src/clock.php',
    //     success: function(data) {
    //       $('#clock').html(data);
    //     }
    //   });
    // }
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
                    html += `<div class="col-3">
                              <div class="mt-1" style="background-color: #28a745; opacity:0.9; margin: 0;">
                                <div class="row" style="padding: 5px 10px;">
                                  <div class="col-2 d-flex align-items-center justify-content-center">
                                    <h6 class="text-light text-center" style="text-orientation: upright; transform: rotate(270deg);">`+ data[i].roomnr +`</h6>
                                  </div>
                                    <div class="col-10">
                                      <h6 class="text-light text-center" style="margin: 0;">`+ data[i].firstname+" "+data[i].insertion+" "+data[i].lastname +`</h6>
                                      <h6 class="text-light text-center" style="margin: 0;">`+ data[i].function +`</h6>
                                    </div>
                                </div>
                              </div>
                            </div>`;  
                } else {
                    html += `<div class="col-3">
                                <div class="mt-1" style="background-color:#C0C0C0; opacity:0.7; margin: 0;">
                                  <div class="row" style="padding: 5px 10px;">
                                      <div class="col-12">
                                        <h6 class="text-center" style="margin: 0; color: #808080;">`+ data[i].firstname+" "+data[i].insertion+" "+data[i].lastname +`</h6>
                                        <h6 class="text-center" style="margin: 0; color: #808080;">`+ data[i].function +`</h6>
                                      </div>
                                  </div>
                                </div>
                              </div>`;                
                }
                }

                // Update the HTML of the employee list element
                $('#namecards').html(html);
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
