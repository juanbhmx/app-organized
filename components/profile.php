<?php include '../includes/conf.php';
session_start();

if (!isset($_SESSION['username'])) {
    header('location: ../index');
}

$usuario = $_SESSION['username'];

$sql = ("SELECT * FROM tbl_user WHERE username = '$usuario'");
$r = $con->query($sql);
$rr = $r->fetch_assoc();

$query = ("SELECT * FROM tbl_session WHERE username = '$usuario' order by fecha desc limit 1");
$res = $con->query($query);
$row2 = $res->fetch_assoc();


// $user_ip = $row2['ip'];;

// $url = "http://ipinfo.io/189.212.125.47";
// $ip_info = json_decode(file_get_contents($url));

// $ip = $ip_info->ip;
// $host = $ip_info->hostname;
// $city = $ip_info->city;
// $region = $ip_info->region;
// $country = $ip_info->country;
// $loc = $ip_info->loc;
// $loc_array = explode(',', $loc);
// $lat = $loc_array[0];
// $long = $loc_array[1];
// $org = $ip_info->org;
// $postal = $ip_info->postal;

// echo '<strong>Dirección IP   </strong>' . $ip . '<br>';
// echo '<strong>Host Name   </strong>' . $host . '<br>';
// echo '<strong>Ciudad    </strong>' . $city . '<br>';
// echo '<strong>Region    </strong>' . $region . '<br>';
// echo '<strong>Codigo País  </strong>' . $country . '<br>';
// echo '<strong>Localización   </strong>' . 'Lat' . $lat . '' . 'Long' . $long . '<br>';
// echo '<strong>Org   </strong>' . $org . '<br>';
// echo '<strong>Portal Code    </strong>' . $postal . '<br>';




// echo getenv('HTTP_CLIENT_IP');


// echo getenv('HTTP_X_FORWARDED_FOR');


// echo getenv('HTTP_X_FORWARDED');


// echo getenv('HTTP_FORWARDED_FOR');


// echo getenv('HTTP_FORWARDED');


// echo getenv('REMOTE_ADDR');

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile | @<?php echo $_SESSION['username']  ?></title>

    <link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../plugins/animate-css/animate.css">
    <link rel="stylesheet" href="../css/profile-user.css">
    <link rel="stylesheet" href="../reemplazar/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../plugins/jQuery/jquery.min.js"></script>
    <link href="../reemplazar/dark.css" rel="stylesheet">
    <script src="../reemplazar/sweetalert2.min.js"></script>
    <script src="../reemplazar/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="../reemplazar/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="../reemplazar/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="../reemplazar/css2.css" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../img/logo 72x72.png">


    <!-- <link rel="stylesheet" href="../plugins/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="../plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../plugins/animate-css/animate.css">
    <link rel="stylesheet" href="../css/profile-user.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="../plugins/jQuery/jquery.min.js"></script>
    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anonymous+Pro:ital@1&family=Permanent+Marker&family=Poppins:wght@200&display=swap" rel="stylesheet"> -->

</head>

<body class="d-flex justify-content-center">

    <div class="container" id="bluraction">
        <div class="d-flex justify-content-center align-items-center mt-4">
            <h6 class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">Menú</h6>
            <sup><a href="#" class="badge badge-danger rounded-pill">1</a></sup>
        </div>
        <nav class="navbar navbar-expand-lg navbar-dark navbarcolor">
            <!-- <a class="navbar-brand" href="#">Navbar</a> -->


            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="../backend/logout.php">Cerrar Sesión <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Dropdown link
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>


        <div class="d-flex justify-content-center">
            <div class="d-flex profile h-20 w-20">
                <div class="d-flex align-items-center">
                    <h1 class="fw-bold" style="font-weight: 200;">
                        <?php 
                        $inicialname = '';
                        $inicial = '';
                        $nameini = explode(" ", $rr['nombre']);
                        $name = explode(" ", $rr['apellidos']);
                        foreach($nameini as $s){
                            $inicialname .=  $s[0];
                        }
                        foreach($name as $x){
                            $inicial .=  $x[0];
                        }
                        echo $inicialname . $inicial;
                        ?>
                    </h1>
                </div>
                <!-- <img src="../img/2.jpg" alt="profile"> -->
                <!-- si tiene foto entonces imprimeme su foto si no enctonces imprimeme sus iniciales beibi -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 name d-flex justify-content-center mt-4">
                <h5><?php echo $rr['nombre'];
                    echo "&nbsp;";
                    $name = explode(" ", $rr['apellidos']);
                    echo $name[0];
                    ?></h5>
            </div>
            <div class="col-md-12 description d-flex justify-content-center">
                <p>Perra asquerosa</p>
            </div>
        </div>
        <div class="d-flex">
            <div class="col-md-12 botonesaction d-flex justify-content-center">
                <button class="btn btn-success addStory"><i class="fa fa-plus-circle"></i> Add acount</button>
                <button class="btn edit-profile"><i class="fa fa-edit"></i> Edit profile</button>
            </div>
        </div>
        <hr />
        <div class="friends">
            <p class="live"><i class="fa fa-clock"></i> Ultima visita: <strong>02:45 pm</strong> </p>
            <p class="live"><i class="fa fa-calendar"></i> Fecha: <strong><?php echo $row2['fecha']; ?></strong></p>
            <p class="live"><i class="fa fa-user"></i> IP<strong> <?php echo $row2['ip']; ?></strong></p>

            <p class="live"><i class="fa fa-home"></i> Ciudad:<strong> Del paseo residencial, Monterrey</strong></p>
        </div>
        <hr />

        <div class="col-md-12 botonesaction d-flex justify-content-center mb-4 row" id="changeAll">
            <!-- <div class="" id="cardshome"> -->

            <!-- </div> -->
        </div>
    </div>



    <script>
        function rebajesSaldo() {
            var inversion = $("#inversion").val()
            var retiro = $("#retiro").val()
            var resta = inversion - retiro
            // alert(inversion)
            // alert(retiro)
            $("#inver").html("$" + resta + ".00")
        }

        $(document).ready(function() {
            $.ajax({
                type: "POST",
                url: "home.php",
                cache: false,
                success: function(data) {
                    $("#changeAll").html(data)
                    rebajesSaldo()
                }
            })


            $("#catenviar").on("click", function() {
                var cant = $("#cant").val()
                // alert(cant)
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
                        // rebajesSaldo()
                        $("#cant").val("")
                    }
                })
            })

            $("#cantretirar").on("click", function() {
                var cant = $("#cant").val()
                // alert(cant)
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
                        // rebajesSaldo()
                        cargaCards()
                        $("#cant").val("")
                    }
                })
            })


        })
    </script>

</body>

</html>