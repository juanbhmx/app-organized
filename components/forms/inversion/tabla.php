<?php
session_start();
require_once '../../../includes/conf.php';
$usuario = $_SESSION['username'];
$sql = "SELECT * FROM tbl_inv WHERE user = '$usuario' ORDER BY fecha2 DESC";
$query = $con->query($sql);
if ($query->num_rows > 0) { ?>
    <div class="table-responsive" style="height: 300px; overflow:scroll;">
        <table class="table table-hover table-striped table-borderless" style="font-size: 80%;">
            <thead style="position: sticky; top:0;">
                <tr>
                    <th>Cantidad</th>
                    <th>Movimiento</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <?php
            while ($row = $query->fetch_assoc()) { ?>
                <tbody>
                    <tr>
                        <?php
                        if ($row['movimiento'] == 'RETIRO') { ?>
                            <td class="text-danger">- $<?php echo number_format($row['cantidad'], 2) ?></td>
                            <td class="text-danger"><i class="fas fa-caret-down me-1">&nbsp; </i><?php echo $row['movimiento'] ?></td>
                            <td class="text-danger"><?php echo $row['fecha2'] ?></td>
                        <?php } else if ($row['movimiento'] == 'INGRESO') { ?>
                            <td class="text-success">$<?php echo number_format($row['cantidad'], 2) ?></td>
                            <td class="text-success"><i class="fas fa-caret-up me-1">&nbsp; </i><?php echo $row['movimiento'] ?></td>
                            <td class="text-success"><?php echo $row['fecha2'] ?></td>
                        <?php }
                        ?>
                    </tr>
                </tbody>
            <?php }
            ?>

        </table>
    </div>
<?php } else {
    echo "No hay movimientos";
}
