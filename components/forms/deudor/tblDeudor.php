<?php
session_start();
include "../../../includes/conf.php";
$usuario = $_SESSION['username'];
$sql = "SELECT * FROM tbl_deuda a INNER join tbl_deudor b ON a.id_deudor = b.id and a.user = '$usuario'";
$query = $con->query($sql);
if ($query->num_rows > 0) { ?>
    <div class="d-flex justify-content-center row">
        <div class="col-sm-12 table-responsive mb-4">
            <div class="table-responsive" style="height: 300px; overflow:scroll;">
                <table class="table table-hover table-striped table-borderless" style="font-size: 80%;">
                    <thead style="position: sticky; top:0;">
                        <tr>
                            <!-- <th scope="col">QR</th> -->
                            <th scope="col">Monto</th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Deudor</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <td><?php echo "$" . number_format($row['monto'], 2) ?></td>
                                <td><?php echo $row['concepto'] ?></td>
                                <td><?php echo $row['nombre'] ?></td>
                                <td>
                                    <button class="btn btn-warning editar-deuda" data-deudor="<?php echo $row['id_deudor'] ?>" data-iddeuda="<?php echo $row['id_deuda'] ?>" data-monto="<?php echo $row['monto'] ?>"><i class="fa fa-edit"></i></button>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } else {
    echo "<p>Ningún registro fue encontrado</p>";
} ?>

<script>
    function tblDeudor() {
        $.ajax({
            type: "POST",
            url: "forms/deudor/tblDeudor.php",
            cache: false,
            success: function(data) {
                $("#tabladata").html(data)
            }
        })
    }
    $(document).on("click", ".editar-deuda", function() {
        var deudor = $(this).data("deudor")
        var id = $(this).data("monto")

        // console.log(Intl.NumberFormat('es-MX',{style:'currency',currency:'MXN'}).format(id))
        $("#bluraction").addClass("bluraction")
        Swal.fire({
            title: 'Monto a pagar',
            html: '<input id="swal-input2" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Monto: $5,500.00" value="' + id + '" disabled>' +
                '<input id="activa" class="swal2-input" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Deuda activa">',
            focusConfirm: false,
            preConfirm: () => {
                var monto = $("#swal-input2").val()
                var rebaja = $("#activa").val()
                var ahora = (monto - rebaja)
                var iddeuda = $(this).data("iddeuda")
                console.info(iddeuda)
                if (rebaja != "") {
                    $.ajax({
                        type: "POST",
                        url: "forms/deudor/bajarDeuda.php",
                        cache: false,
                        data: {
                            ahora: ahora,
                            deudor: deudor,
                            iddeuda: iddeuda
                        },
                        success: function(data) {
                            $("#tablainversiones").html(data)
                            $("#bluraction").removeClass("bluraction")
                            tblDeudor()
                        }
                    })
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Deuda pagada',
                        showConfirmButton: false,
                        timer: 2500
                    })
                } else if (rebaja <= 0) {
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
    })
</script>