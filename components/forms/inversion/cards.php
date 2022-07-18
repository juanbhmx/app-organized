<?php
session_start();
require_once '../../../includes/conf.php';
?>


<div class="col-sm-6 cursor col-sm-6 table-responsive">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <?php
                    $usuario = $_SESSION['username'];
                    $sql = "SELECT SUM(cantidad) as inversion FROM tbl_inv WHERE movimiento = 'INGRESO' and user = '$usuario'";
                    $query = $con->query($sql);
                    $row = $query->fetch_assoc();
                    echo '<input type="hidden" value="' . $row['inversion'] . '" name="" id="inversion">';
                    echo '<h3 id="inver">$ ' .  number_format($row['inversion'], 2)  . '</h3>';
                    ?>
                    <p class="mb-0 text-success">Inversión activa</p>
                </div>
                <div class="align-self-center">
                    <i class="fa-solid fa-money-bill-trend-up 3x text-success"></i>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-6 cursor col-sm-6 table-responsive">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between px-md-1">
                <div>
                    <?php
                    $usuario = $_SESSION['username'];
                    $sql = "SELECT SUM(cantidad) as retiro FROM tbl_inv WHERE movimiento = 'RETIRO' and user = '$usuario'";
                    $query = $con->query($sql);
                    $row = $query->fetch_assoc();
                    echo '<input type="hidden" value="' . $row['retiro'] . '" name="" id="retiro">';
                    echo '<h3>$ ' . number_format($row['retiro'], 2) . '</h3>';
                    ?>
                    <p class="mb-0 text-danger">Retiros</p>
                </div>
                <div class="align-self-center">
                    <i class="fa-solid fa-money-bill-trend-up 3x text-danger"></i>
                </div>
            </div>
        </div>
    </div>
</div>

