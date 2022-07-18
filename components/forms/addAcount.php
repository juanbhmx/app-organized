<?php
include "../../includes/conf.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir cuenta</title>
    <link rel="stylesheet" href="../../plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../../plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../../plugins/animate-css/animate.css">
    <link rel="stylesheet" href="../../css/style.css">
    <script src="../../plugins/jQuery/jquery.min.js"></script>
</head>

<body>
    <div class="container mt-4">
        <nav>
            <a href="../../backend/logout.php">Cerrar Sesión</a>
            
        </nav>
        <div class="card">
            <div class="card-header d-flex justify-content-center">
                <p>Agregar Cuenta</p>
            </div>
            <form class="mb-4" id="dataAcount" autocomplete="off" method="post">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <label for="url">Url:</label>
                            <input type="text" class="form-control" name="url" id="url" placeholder="www.brocoland.mx">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="cuenta">Cuenta:</label>
                            <input type="text" class="form-control" name="user" id="user" placeholder="juanbh">
                        </div>
                        <div class="form-group col-md-4">
                            <label for="pass">Password:</label>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="123456789">
                        </div>
                        <div class="col d-flex justify-content-center">
                            <input type="submit" id="envia" class="btn btn-success envia-acount" value="Añadir Cuenta">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    </div>
    <div class="container mt-4">
        <hr />
        <div class="d-flex justify-content-center">
        <p>Cuentas registradas</p>
        </div>
        <hr />
        <div class="table-responsive" id="divtable">

        </div>
        <footer>
            <div class="card-footer d-flex justify-content-center">Dev - @juanbhmx</div>
        </footer>
    </div>

    <script>
        $(document).ready(function() {
            $.ajax({
                type: "post",
                url: "tableData.php",
                cache: false,
                success: function(response) {
                    $("#divtable").html(response)
                }
            })
        })
        
        $("#dataAcount").submit(function(e) {
            e.preventDefault();
            var form = $("#dataAcount")
            var data = new FormData(form[0]);
            var ur = "../../backend/addAcountBack.php"
            $.ajax({
                type: "POST",
                url: ur,
                data: data,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response == 0) {
                        CargaTable()
                    } else {
                        alert("no se envío, no sirves como programador")
                    }
                }
            })
            return false
        })

        function CargaTable() {
            $.ajax({
                type: "post",
                url: "tableData.php",
                cache: false,
                success: function(response) {
                    $("#divtable").html(response)
                }
            })
        }

        $(".borrar-acount").on("click", function(){
           alert("eliminar btn")
        })

        // $("#envia").on("click", function() {

        // })
    </script>
</body>

</html>