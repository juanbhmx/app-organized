<?php
session_start();
include '../includes/conf.php';
$usuario = $_SESSION['username'];
$sql = "SELECT * from tbl_inv where movimiento = 'INGRESO' and user = '$usuario'";
$query = $con->query($sql);
$data = array();
while ($r = $query->fetch_object()) {
    $data[] = $r;
}

$sql2 = "SELECT * from tbl_inv where movimiento = 'RETIRO' and user = '$usuario'";
$query2 = $con->query($sql2);
$data2 = array();
while ($r2 = $query2->fetch_object()) {
    $data2[] = $r2;
}
?>

<canvas id="lineChart"></canvas>


<script>
    var ctxL = document.getElementById("lineChart").getContext('2d');
    var myLineChart = new Chart(ctxL, {
        type: 'line',
        data: {
            labels: [<?php foreach ($data as $d) : ?> "<?php echo $d->fecha2 ?>",
                <?php endforeach; ?>
            ],
            datasets: [{
                    label: "INVERSIÓN",
                    data: [<?php foreach ($data as $d) : ?>
                            <?php echo $d->cantidad; ?>,
                        <?php endforeach; ?>
                    ],
                    backgroundColor: [
                        'rgb(0, 153, 66)',
                    ],
                    borderColor: [
                        'rgb(0, 208, 90)',
                    ],
                    borderWidth: 2
                },
                // --------------------------------------
                {
                    label: "RETIROS",
                    data: [<?php foreach ($data2 as $d2) : ?>
                            <?php echo $d2->cantidad; ?>,
                        <?php endforeach; ?>
                    ],
                    backgroundColor: [
                        'rgba(220, 53, 69)',
                    ],
                    borderColor: [
                        'rgba(220, 53, 89)',
                    ],
                    borderWidth: 2
                }
            ]
        },
        options: {
            responsive: true
        }
    });
    // }
</script>