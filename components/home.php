<?php include '../includes/conf.php';
session_start(); ?>
<div class="col-sm-6 cursor col-sm-6 table-responsive" id="acountsStorage">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-success">
                        <?php
                        $usuario = $_SESSION['username'];
                        $sql2 = "SELECT COUNT(url) as cant FROM tbl_acounts WHERE usuario = '$usuario'";
                        $query2 = $con->query($sql2);
                        // $row2 = $query2->fetch_assoc();
                        if ($query2->num_rows > 0) {
                            $row2 = $query2->fetch_assoc();
                            echo $row2['cant'];
                        } else {
                            echo "no hay";
                        }
                        ?>
                    </h3>
                    <p class="mb-0 text-success">Cuentas Almacenadas</p>
                </div>
                <div class="align-self-center">
                    <i class="fas fa-key text-success fa-3x"></i>
                </div>
            </div>
            <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="Toggle blue light"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 cursor col-sm-6 table-responsive" id="inversiones">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-success">
                        <?php
                        $usuario = $_SESSION['username'];
                        $sql = "SELECT SUM(cantidad) as inversion FROM tbl_inv WHERE movimiento = 'INGRESO' and user = '$usuario '";
                        $query = $con->query($sql);
                        $row = $query->fetch_assoc();
                        echo '<input type="hidden" value="' . $row['inversion'] . '" name="" id="inversion">';
                        echo '<h3 class="text-success" id="inver">$&nbsp;' .  number_format($row['inversion'], 2) . '</h3>';
                        ?>
                        <?php
                        $usuario = $_SESSION['username'];
                        $sql = "SELECT SUM(cantidad) as inversion FROM tbl_inv WHERE movimiento = 'RETIRO' and user = '$usuario '";
                        $query = $con->query($sql);
                        $row = $query->fetch_assoc();
                        echo '<input type="hidden" value="' . $row['inversion'] . '" name="" id="retiro">';
                        ?>
                    </h3>
                    <p class="mb-0 text-success">Inversión</p>
                </div>
                <div class="align-self-center">
                    <i class="fa-solid fa-wallet fa-3x text-success"></i>
                </div>
            </div>
            <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="Toggle blue light"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 cursor col-sm-6 table-responsive" id="deudores">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <h3 class="text-success">
                        <h3 class="text-success">
                            <?php
                            $usuario = $_SESSION['username'];
                            $sql = "SELECT SUM(monto) as deuda FROM tbl_deuda WHERE user = '$usuario '";
                            $query = $con->query($sql);
                            $row = $query->fetch_assoc();
                            echo "$" . number_format($row['deuda'], 2);
                            ?>
                        </h3>
                        <p class="mb-0 text-success">Deudores</p>
                </div>
                <div class="align-self-center">
                    <i class="fa-solid fa-hand-holding-dollar fa-3x text-success"></i>
                </div>
            </div>
            <div class="px-md-1">
                <div class="progress mt-3 mb-1 rounded" style="height: 7px">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" aria-label="Toggle blue light"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $("#acountsStorage").on("click", function() {
        $.ajax({
            type: "POST",
            url: "forms/tableData.php",
            cache: false,
            success: function(data) {
                $("#changeAll").html(data)
            }
        })
    })

    $("#inversiones").on("click", function() {
        $.ajax({
            type: "POST",
            url: "bank.php",
            cache: false,
            success: function(data) {
                $("#changeAll").html(data)
                cargaTableinversion()
                cargaCards()
                cargaGrafica()
            }
        })
    })

    $("#deudores").on("click", function() {
        $.ajax({
            type: "POST",
            url: "deudores.php",
            cache: false,
            success: function(data) {
                $("#changeAll").html(data)
                cargaTableinversion()
                cargaCards()
                cargaGrafica()
            }
        })
    })

    function cargaGrafica() {
        $.ajax({
            type: "POST",
            url: "chartGraph.php",
            cache: false,
            success: function(data) {
                $("#grafica").html(data)
            }
        })
    }

    function cargaTableinversion() {
        $.ajax({
            type: "POST",
            url: "forms/inversion/tabla.php",
            cache: false,
            success: function(data) {
                $("#tablainversiones").html(data)
            }
        })
    }

    function cargaCards() {
        $.ajax({
            type: "POST",
            url: "forms/inversion/cards.php",
            cache: false,
            success: function(data) {
                $("#cards").html(data)
                rebajesSaldo()
            }
        })
    }
</script>