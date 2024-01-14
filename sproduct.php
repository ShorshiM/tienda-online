<?php 
    include('backend/conexion.php');

    $con = connection();

    session_start();

	if(!empty($_SESSION['id'])){
		$nomUser = $_SESSION['nombre']." ".$_SESSION['apellido'];
        $cerrar = true;
	}else{
        $cerrar = false;
    }

    $variable = $_REQUEST['nombre'];
    $sql = "SELECT * FROM productos WHERE nombre = '$variable'";
    $sql1 = "SELECT * FROM productosTendencia WHERE nombre = '$variable'";
    

    $query = mysqli_query($con, $sql);
    $query1 = mysqli_query($con, $sql1);
    

    $row = mysqli_fetch_array($query);
    $row1 = mysqli_fetch_array($query1);
    $random = random_int(2,8);

    if($row){
        $nombre = $row['nombre'];
        $costo = $row['precio'];
        $cantidad = $row['cantidad'];
        $imagen = $row['imagen'];
        $sql_list = "SELECT * FROM productos";
    }elseif($row1){
        $nombre = $row1['nombre'];
        $costo = $row1['precio'];
        $cantidad = $row1['cantidad'];
        $imagen = $row1['imagen'];
        $sql_list = "SELECT * FROM productosTendencia";
    }
    $query_list = mysqli_query($con, $sql_list);
    $contador = 0;
    while($row = mysqli_fetch_array($query_list)){
        $lista_nombre[$contador] = $row['nombre'];
        $lista_costo[$contador] = $row['precio'];
        $lista_cantidad[$contador] = $row['cantidad'];
        $lista_imagen[$contador] = $row['imagen'];
        $contador += 1;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caperucita M&M</title>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.15.4/css/all.css" />

    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><p><?php if($cerrar):?><?php echo $nomUser;?><?php echo "<a href='controlador/con_cerrar_sesion.php'><i class='fa-solid fa-chevron-up fa-rotate-180'></i></a>"?><?php endif;?></p></li>
                <li><?php if(!$cerrar):?><?php echo "<a href='login.php'>Log In</a>";?><?php endif;?></li>
                <li id="lg-bag"><a href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php?nombre=0"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="data:image/png;base64,<?php echo base64_encode($imagen)?>" width="100%" id="MainImg" alt=""/>
        </div>
        <div class="single-pro-details">
            <h6>Home / Ropa</h6>
            <h4><?=$nombre?></h4>
            <h2>$ <?=$costo?></h2>
            <form action="cart.php" method="post">
                <select required>
                    <option>Selecciona tamaño</option>
                    <option>2XL</option>
                    <option>XL</option>
                    <option>L</option>
                    <option>M</option>
                    <option>S</option>
                </select >
                <input type="number" value="1" name="txtCantidad">
                <input type="hidden" value="<?php echo $nombre;?>" name="txtNombre">
                <div>
                    <button type="submit" class="normal" >Agregar al Carrito</button>
                </div>
            </form>
            <h4>Detalles del producto</h4>
            <span>
                Esta ropa para perrito le dará moda y estilo para viajar a cualquier lado, es lo ultimo en tendencia
                para la felicidad de ellos
            </span>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Productos similares</h2>
        <p>Por si te interesa</p>
        <div class="pro-container">
            <?php for($x=0; $x<4; $x++):?>
            <?php $x = $x + $random;?>
            <div class="pro">
                <img src="data:image/png;base64,<?php echo base64_encode($lista_imagen[$x])?>"/>
                <div class="des">
                    <span>Vestido para perritos</span>
                    <h5><?=$lista_nombre[$x]?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$ <?=$lista_costo[$x]?></h4>
                </div>
                <a href="sproduct.php?nombre=<?php echo $lista_nombre[$x];?>"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <?php  $x = $x - $random;?>
            <?php endfor;?>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/logo.png" alt="">
            <h4>Contactos</h4>
            <p><strong>Dirección: </strong>Reina Victoria & General Baquedano, Quito 170143</p>
            <p><strong>Contactos: </strong>(02) 4501068/+593 98 775 1076</p>
            <p><strong>Atención: </strong>10:00 a 18:30 Lunes a Domingo</p>
            <div class="follow">
                <h4>Síguenos en</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-youtube"></i>
                    <i class="fab fa-tiktok"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="about.html">Sobre Nosotros</a>
            <a href="about.html">Información de entrega</a>
            <a href="about.html">Política de privacidad</a>
            <a href="about.html">Términos & Condiciones</a>
            <a href="contact.php">Contáctenos</a>
        </div>
        <div class="col">
            <h4>Carrito</h4>
            <a href="cart.php?nombre=0">Ver carrito</a>
            <a href="cart.php?nombre=0">Ver mi pedido</a>
            <a href="contact.php">Ayuda</a>
        </div>
        <div class="col install">
            <h4>Instalar App</h4>
            <p>En App Store o Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Formas de pago</p>
            <img src="img/pay/pay.png" alt="">
        </div>
        <div class="copyright">
            <p>©2023, Caperucita M&M - Todos los derechos reservados</p>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>