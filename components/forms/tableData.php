<div class="d-flex justify-content-center row">

    <div class="d-flex card-header justify-content-center align-items-center mb-4">
        <i class="fa-solid fa-arrow-left click" id="home"> </i>
        <h5>&nbsp; Administrador de Cuentas</h5>
    </div>
    <div class="col-md-12 botonesaction d-flex justify-content-center mb-4">
        <button type="" class="btn btn-success inversion" id="addAcount"><i class="fa fa-plus-circle"></i> Add</button>
    </div>

    <div id="tablaacounts">{{tabla}}</div>
</div>


<script>
    $(document).ready(() => {
        $.ajax({
            type: "POST",
            url: "../components/forms/acounts/acountsTbl.php",
            cache: false,
            success: function(data) {
                $("#tablaacounts").html(data)
            }
        })
    })

    $("#home").on("click", function() {
        $.ajax({
            type: "POST",
            url: "home.php",
            cache: false,
            success: function(data) {
                $("#changeAll").html(data)
                rebajesSaldo()
            }
        })
    })



    $("#addAcount").on("click", function() {
        $("#bluraction").addClass("bluraction")
        Swal.fire({
            title: 'Datos de la cuenta',
            html: '<input id="url" class="swal2-input" placeholder="www.google.com" required>' + '<input id="user" class="swal2-input" placeholder="brocolimx">' + '<input id="contrasena" type="password" class="swal2-input" placeholder="********">',
            focusConfirm: false,
            preConfirm: () => {
                var url = $("#url").val()
                var acount = $("#user").val()
                var pass = $("#contrasena").val()
                if (pass !== "") {
                    $.ajax({
                        type: "POST",
                        url: "../backend/addAcountBack.php",
                        cache: false,
                        data: {
                            url: url,
                            acount: acount,
                            pass: pass
                        },
                        success: function(data) {
                            recargaTbl()
                            $("#bluraction").removeClass("bluraction")
                        }
                    })
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Cuenta guardada de: ' + url,
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (pass == "") {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ingresa datos webon',
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $("#bluraction").removeClass("bluraction")
                }
            },
            // showCancelButton: true,
            allowOutsideClick: false,
            allowEscapeKey: false,
        })
    })
</script>