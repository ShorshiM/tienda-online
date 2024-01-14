<?php
    include('backend/conexion.php');
    $con = connection();

    session_start();

	if(!empty($_SESSION['id'])){
		$nomUser = $_SESSION['nombre']." ".$_SESSION['apellido'];
        $descuento = 0.1;
        $cerrar = true;
	}else{
        $descuento = 0;
        $cerrar = false;
    }
    $val = false;
    if(!empty($_REQUEST['val'])){
        if($_REQUEST['val'] == "true"){
            $val = true;
        }
    }

    $total = 0;
    if(!empty($_POST['txtNombre']) && !empty($_POST['txtCantidad'])){
        $variable = $_POST['txtNombre'];
        $sql = "SELECT * FROM productos WHERE nombre = '$variable'";
        $sql1 = "SELECT * FROM productosTendencia WHERE nombre = '$variable'";

        $query = mysqli_query($con, $sql);
        $query1 = mysqli_query($con, $sql1);

        $row = mysqli_fetch_array($query);
        $row1 = mysqli_fetch_array($query1);
        $cantidad = $_POST['txtCantidad'];
        if($cantidad<1){
            $cantidad = 1;
        }
        if($row){
            $nombre = $row['nombre'];
            $costo = $row['precio'];
        }elseif($row1){
            $nombre = $row1['nombre'];
            $costo = $row1['precio'];
        }

        if($cantidad > 3){
            $subTotal = $cantidad * ($costo - ($costo * 0.1));
        }else{
            $subTotal = $cantidad * $costo;
        }
        $subTotal = round($subTotal, 2);
        $sql = "INSERT INTO carrito(nombre, precio, cantidad, subtotal) VALUES('$nombre', '$costo', '$cantidad', '$subTotal')";
        $query = mysqli_query($con, $sql);
    }
    $sql1 = "SELECT * FROM carrito";
    $query1 = mysqli_query($con, $sql1);
    $contador = 0;

    while($row = mysqli_fetch_array($query1)){
        //$nombres[$contador] = $row['nombre'];
        $total += $row['subtotal'];
        $contador += 1;
    }
    $query1 = mysqli_query($con, $sql1);
    $pago = 0;
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
                <li><a href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><p><?php if($cerrar):?><?php echo $nomUser;?><?php echo "<a href='controlador/con_cerrar_sesion.php'><i class='fa-solid fa-chevron-up fa-rotate-180'></i></a>"?><?php endif;?></p></li>
                <li><?php if(!$cerrar):?><?php echo "<a href='login.php'>Log In</a>";?><?php endif;?></li>
                <li id="lg-bag"><a class="active" href="cart.php"><i class="far fa-shopping-bag"></i></a></li>
                <a href="#" id="close"><i class="far fa-times"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.php?nombre=0"><i class="far fa-shopping-bag"></i></a>
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header" class="about-header">
        <h2>#Tu cartera</h2>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <td>Eliminar</td>
                    <td>Producto</td>
                    <td>Precio</td>
                    <td>Cantidad</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php while($row = mysqli_fetch_array($query1)):?>
                <tr>
                    <td><a href="backend/eliminar.php?id=<?php echo $row['ID'];?>"><i class="far fa-times-circle"></i></a></td>
                    <td><?=$row['nombre']?></td>
                    <td>$ <?=$row['precio']?></td>
                    <td><?=$row['cantidad']?></td>
                    <td>$ <?=$row['subtotal']?></td>
                </tr>
                <?php endwhile;?>
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
        <div id="datos">
            <h3>Primero envíe los datos</h3>
            <div>
                <?php 
                    if($descuento > 0 && $total > 15){
                        $pago = $total - ($total*$descuento);
                        $pago = round($pago, 2);
                    }
                ?>
                <form action="backend/datos.php?total=<?php echo $pago;?>" method="post">
                        <input type="text" required placeholder="Nombre" name="nombre">
                        <input type="text" required placeholder="Dirección" name="direccion">
                        <input type="email" required placeholder="correo" name="correo">
                        <input type="submit" value="Enviar" class="normal" id="enviar">
                </form>
            </div>
        </div>
        <div id="subtotal">
            <h3>Total</h3>
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>$ <?=$total?></td>
                </tr>
                <tr>
                    <td>Entrega</td>
                    <td>Gratis</td>
                </tr>
                <tr>
                    <?php 
                    if($descuento > 0 && $total > 15):
                    ?>
                    <td><strong>Total(Descuento 10%)</strong></td>
                    <td><strong>$ <?=$pago ?></strong></td>
                    <?php else: ?>
                    <td><strong>Total</strong></td>
                    <td><strong>$ <?=$pago?></strong></td>
                    <?php endif;?>
                </tr>
            </table>
            <?php if($val):?>
                <button class="normal" onclick="window.location.href='backend/pdf.php?total=<?php echo round($pago, 2);?>';">Comprar</button>
            <?php endif;?>
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