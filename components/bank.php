<div class="d-flex justify-content-center row">
    <div class="d-flex card-header justify-content-center align-items-center mb-4">
        <i class="fa-solid fa-arrow-left click" id="atras"> </i>
        <h5>&nbsp; Administrador de inversiones</h5>
    </div>
    <div class="col-md-12 botonesaction d-flex justify-content-center mb-4">
        <button type="" class="btn btn-success inversion" id="enviainversion"><i class="fa fa-plus-circle"></i> Invertir</button>
        <button class="btn retiro" id="cantretirar"><i class="fa fa-plus-circle"></i> Retirar</button>
    </div>
    <hr />
    <div class="d-flex col-md-12  justify-content-center mb-4" id="cards"></div>
    <div class="col-sm-12 table-responsive mb-4" id="tablainversiones">inversiones</div>
    <div class="col-sm-12 table-responsive mb-4" id="grafica">Grafica</div>
</div>

<script>
    $("#atras").on("click", function(){
        $.ajax({
            type:"POST",
            url:"home.php",
            cache: false,
            success: function(data){
                $("#changeAll").html(data)
                rebajesSaldo()
            }
        })
    })

    $("#enviainversion").on("click", function() {
        $("#bluraction").addClass("bluraction")
        Swal.fire({
            title: 'Cantidad a Invertir',
            html: '<input id="swal-input2" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57">',
            focusConfirm: false,
            preConfirm: () => {
                var cant = $("#swal-input2").val()
                if (cant > 0) {
                    $.ajax({
                        type: "POST",
                        url: "forms/inversion/invertir.php",
                        cache: false,
                        data: {
                            cant: cant
                        },
                        success: function(data) {
                            $("#tablainversiones").html(data)
                            cargaTableinversion()
                            rebajesSaldo()
                            cargaCards()
                            cargaGrafica()
                            $("#bluraction").removeClass("bluraction")
                        }
                    })
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Inversión guardada ' + "$" + cant,
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (cant <= 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ingresa Cantidad mayor a $0',
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


    $("#cantretirar").on("click", function() {
        $("#bluraction").addClass("bluraction")
        Swal.fire({
            title: 'Cantidad a Retirar',
            html: '<input id="swal-input2" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57">' +
                '<p id="resultado"></p>',
            focusConfirm: false,
            preConfirm: () => {
                var cant = $("#swal-input2").val()
                if (cant > 0) {
                    $.ajax({
                        type: "POST",
                        url: "forms/inversion/retirar.php",
                        cache: false,
                        data: {
                            cant: cant
                        },
                        success: function(data) {
                            $("#tablainversiones").html(data)
                            cargaTableinversion()
                            rebajesSaldo()
                            cargaCards()
                            cargaGrafica()
                            $("#bluraction").removeClass("bluraction")
                        }
                    })
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Retiro existoso ' + "$" + cant,
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (cant <= 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ingresa Cantidad mayor a $0',
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

    function rebajesSaldo() {
        var inversion = $("#inversion").val()
        var retiro = $("#retiro").val()
        var resta = inversion - retiro
        $("#inver").html("$" + resta+".00")
    }
</script>