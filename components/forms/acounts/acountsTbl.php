<?php
session_start();
    include "../../../includes/conf.php";
    $usuario = $_SESSION['username'];
    $sql = "SELECT * FROM tbl_acounts WHERE usuario = '$usuario'";
    $query = $con->query($sql);
    if ($query->num_rows > 0) { ?>
        <div class="col-sm-12 table-responsive mb-4">
            <div class="table-responsive" style="height: 300px; overflow:scroll;">
                <table class="table table-hover table-striped table-borderless" style="font-size: 80%;">
                    <thead style="position: sticky; top:0;">
                        <tr>
                            <!-- <th scope="col">QR</th> -->
                            <th scope="col">Url o App</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Contraseña</th>
                            <!-- <th scope="col">Action</th> -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $query->fetch_assoc()) { ?>
                            <tr>
                                <!-- <th scope="row"><?php echo $row['id_acount'] ?></th> -->
                                <td><?php echo $row['url'] ?></td>
                                <td><?php echo $row['user'] ?></td>
                                <td><?php echo $row['password'] ?></td>
                                <!-- <td>
                        <button class="btn btn-warning editar-acount"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger borrar-acount"><i class="fa fa-trash"></i></button>
                    </td> -->
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else {
        echo "<p>Ningún registro fue encontrado</p>";
    } ?>