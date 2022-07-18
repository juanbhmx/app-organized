<div class="d-flex justify-content-center row">
    <div class="d-flex card-header justify-content-center align-items-center mb-4">
        <i class="fa-solid fa-arrow-left click" id="atras"> </i>
        <h5>&nbsp; Administrador de Deudores</h5>
    </div>
    <div class="col-md-12 botonesaction d-flex justify-content-center mb-4">
        <button type="" class="btn btn-success inversion" id="adddeudor"><i class="fa fa-plus-circle"></i> Agregar deudor</button>
        <button class="btn btn-success btn retiro" id="aumentodeuda"><i class="fa fa-plus-circle"></i>&nbsp; Add</button>
        <button class="btn btn-success btn retiro" id="bajardeuda"><i class="fa-solid fa-hand-holding-dollar"></i>&nbsp; Del</button>
    </div>
    <hr />
    <div class="d-flex col-md-12  justify-content-center mb-4" id="tabladata"></div>
</div>


<script>
    $(document).ready(function() {

        $.ajax({
            type: "POST",
            url: "forms/deudor/tblDeudor.php",
            cache: false,
            success: function(data) {
                $("#tabladata").html(data)
            }
        })

    })

    $("#atras").on("click", function() {
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


    $("#adddeudor").on("click", function() {
        $("#bluraction").addClass("bluraction")
        Swal.fire({
            title: 'Nombre del deudor',
            html: '<input id="swal-input2" class="swal2-input">',
            focusConfirm: false,
            preConfirm: () => {
                var name = $("#swal-input2").val()
                if (name != "") {
                    $.ajax({
                        type: "POST",
                        url: "forms/deudor/regDeudor.php",
                        cache: false,
                        data: {
                            name: name
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
                        title: 'Agregado',
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (name <= 0) {
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ingresa el Nombre webon',
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

    function cargaTblDeudas() {
        $.ajax({
            type: "POST",
            url: "forms/deudor/tblDeudor.php",
            cache: false,
            success: function(data) {
                $("#tabladata").html(data)
            }
        })
    }

    $("#aumentodeuda").on("click", function() {
        $.ajax({
            type: "POST",
            url: "forms/deudor/consDeudor.php",
            dataType: 'json',
            success: function(data) {
                var options = {}
                $.map(data.result, function(o) {
                    options[o.id] = o.nombre
                });

                $("#bluraction").addClass("bluraction")
                Swal.fire({
                    title: 'Monto',
                    html: '<input id="swal-input2" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Monto: $5,500.00">' + '<input id="concepto" class="swal2-input" placeholder="Concepto prestamo">',
                    input: 'select',
                    inputOptions: options,
                    inputPlaceholder: 'Selecciona deudor',
                    focusConfirm: false,
                    preConfirm: () => {
                        var monto = $("#swal-input2").val()
                        var concepto = $("#concepto").val()
                        var deudor = $(".swal2-select").val()
                        if (monto != "") {
                            $.ajax({
                                type: "POST",
                                url: "forms/deudor/regDeuda.php",
                                cache: false,
                                data: {
                                    monto: monto,
                                    concepto: concepto,
                                    deudor: deudor
                                },
                                success: function(data) {
                                    $("#tablainversiones").html(data)
                                    cargaTblDeudas()
                                    rebajesSaldo()
                                    $("#bluraction").removeClass("bluraction")
                                }
                            })
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Agregado',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        } else if (monto <= 0) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Ingresa el monto webon',
                                showConfirmButton: false,
                                timer: 2500
                            })
                            $("#bluraction").removeClass("bluraction")
                        }
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })
            }
        })
    })

    $("#bajardeuda").on("click", function() {
        $.ajax({
            type: "POST",
            url: "forms/deudor/consDeudor.php",
            dataType: 'json',
            success: function(data) {
                var options = {}
                $.map(data.result, function(o) {
                    options[o.id] = o.nombre
                });
                $("#bluraction").addClass("bluraction")
                Swal.fire({
                    title: 'Monto a pagar',
                    input: 'select',
                    inputOptions: options,
                    inputPlaceholder: 'Selecciona deudor',
                    html: '<input id="swal-input2" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Monto: $5,500.00">' +
                        '<input id="activa" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Deuda activa">',
                    focusConfirm: false,
                    preConfirm: () => {
                        var monto = $("#swal-input2").val()
                        var deudor = $(".swal2-select").val()
                        console.log(deudor)
                        if (monto != "") {
                            $.ajax({
                                type: "POST",
                                url: "forms/deudor/bajarDeuda.php",
                                cache: false,
                                data: {
                                    monto: monto,
                                    deudor: deudor
                                },
                                success: function(data) {
                                    $("#tablainversiones").html(data)
                                    cargaTblDeudas()
                                    $("#bluraction").removeClass("bluraction")
                                }
                            })
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deuda pagada',
                                showConfirmButton: false,
                                timer: 2500
                            })
                        } else if (monto <= 0) {
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'Ingresa el monto webon',
                                showConfirmButton: false,
                                timer: 2500
                            })
                            $("#bluraction").removeClass("bluraction")
                        }
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                })

            }
        })
    })
</script>