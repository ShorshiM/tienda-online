<?php 
    include('backend/conexion.php');

    session_start();

	if(!empty($_SESSION['id'])){
		$nomUser = $_SESSION['nombre']." ".$_SESSION['apellido'];
        $cerrar = true;
	}else{
        $cerrar = false;
    }

    $con = connection();

    $sql = "SELECT * FROM productos";

    $sql1 = "SELECT * FROM productosTendencia";

    $query = mysqli_query($con, $sql);

    $query1 = mysqli_query($con, $sql1);
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
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
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

    <section id="hero">
        <h4>Productos de oferta</h4>
        <h2>De calidad</h2>
        <h1>Todo tipo de ropa</h1>
        <p>Con nuestros productos tendrás un ahorro mas del 50%!</p>
        <button>Comprar ahora</button>
    </section>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/caracteristicas/f2.png" alt="">
            <h6>Entrega rápida</h6>
        </div>
        <div class="fe-box">
            <img src="img/caracteristicas/f3.png" alt="">
            <h6>Ahorra dinero</h6>
        </div>
        <div class="fe-box">
            <img src="img/caracteristicas/f4.png" alt="">
            <h6>Recibe regalos</h6>
        </div>
        <div class="fe-box">
            <img src="img/caracteristicas/f5.png" alt="">
            <h6>Atención rápida</h6>
        </div>
        <div class="fe-box">
            <img src="img/caracteristicas/f6.png" alt="">
            <h6>Soporte online</h6>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Productos Disponibles</h2>
        <p>Productos nueva tendencia</p>
        <div class="pro-container">
            <?php while($row = mysqli_fetch_array($query)):?>
            <div class="pro">
                <img src="data:image/png;base64,<?php echo base64_encode($row['imagen'])?>"/>
                <div class="des">
                    <span>Ropa para perritos</span>
                    <h5><?=$row['nombre']?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$ <?=$row['precio']?></h4>
                </div>
                <a href="sproduct.php?nombre=<?php echo $row['nombre'];?>"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <?php endwhile;?>
        </div>
    </section>

    <section id="banner" class="section-m1">
        <h4>Grandes ofertas</h4>
        <h2>Productos con asta un <span>50% de descuento</span> en ropa para perritos</h2>
        <button class="normal">Ver productos</button>
    </section>

    <section id="product1" class="section-p1">
        <h2>Nuevos Modelos</h2>
        <p>Productos nueva tendencia</p>
        <div class="pro-container">
            <?php while($row = mysqli_fetch_array($query1)):?>
            <div class="pro">
                <img src="data:image/png;base64,<?php echo base64_encode($row['imagen'])?>"/>
                <div class="des">
                    <span>Vestido para perritos</span>
                    <h5><?=$row['nombre']?></h5>
                    <div class="star">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>$ <?=$row['precio']?></h4>
                </div>
                <a href="sproduct.php?nombre=<?php echo $row['nombre'];?>"><i class="fal fa-shopping-cart cart"></i></a>
            </div>
            <?php endwhile;?>
        </div>
    </section>

    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Tendencia</h4>
            <h2>Compra y gana</h2>
            <span>Los productos de gan calidad y mejor precio</span>
            <button class="white">Leer mas</button>
        </div>
        <div class="banner-box banner-box2">
            <h4>Tendencia</h4>
            <h2>Compra y gana</h2>
            <span>Los productos de gan calidad y mejor precio</span>
            <button class="white">Leer mas</button>
        </div>
    </section>

    <section id="banner3">
        <div class="banner-box">
            <h2>Ropa de descuento</h2>
            <h3>Vestidos de perritos con 25% de descuento</h3>
        </div>
        <div class="banner-box banner-box2">
            <h2>Nueva ropa</h2>
            <h3>Grandes trajes de perritos</h3>
        </div>
        <div class="banner-box banner-box3">
            <h2>Recibe regalo </h2>
            <h3>Regalo para tu mascota</h3>
        </div>
    </section>

    <br>

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