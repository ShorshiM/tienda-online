<?php
session_start();

if(!empty($_SESSION['id'])){
    $nomUser = $_SESSION['nombre']." ".$_SESSION['apellido'];
    $cerrar = true;
}else{
    $cerrar = false;
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
                <li><a href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
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

    <section id="page-header" class="about-header">
        <h2>#Nos ubicamos</h2>
        <p>Si tienes alguna duda o problema no dudes en contactarnos</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>Ponte en contacto</span>
            <h2>Visita nuestra tienda o puedes contactarte con nosotros</h2>
            <h3>Nuestro local</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>Reina Victoria & General Baquedano, Quito 170143, Ecuador</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>caperucitam&m@hotmail.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+593 98 775 1076</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>10:00 a 18:30 Lunes a Domingos</p>
                </li>
            </div>
        </div>
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3989.7931558927944!2d-78.49543512503544!3d-0.20349559979449966!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMMKwMTInMTIuNiJTIDc4wrAyOSczNC4zIlc!5e0!3m2!1ses!2sec!4v1691094442039!5m2!1ses!2sec" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="backend/proceso_guardar.php" method="post">
            <span>Envíanos un mensaje</span>
            <h2>Estaremos felices de escucharte</h2>
            <input type="text" placeholder="Nombre" required name="nombre" id="nom">
            <input type="email" placeholder="Correo" required name="correo" id="cor">
            <input type="text" placeholder="Asunto" required name="asunto" id="asu">
            <textarea name="mensaje" required id="men" cols="30" rows="10" placeholder="Mensaje" ></textarea>
            <button type="submit" class="normal">Enviar</button>
        </form>
        <div class="people">
            <div>
                <img src="img/people/1.png" alt="">
                <p><span>Jhin Due</span>Senior marketing manager <br>Phone: + 000 123 000 <br> Email: jhin.due@hotmail.com</p>
            </div>
            <div>
                <img src="img/people/2.png" alt="">
                <p><span>William Smith</span>Senior marketing manager <br>Phone: + 000 123 000 <br> Email: jhin.due@hotmail.com</p>
            </div>
            <div>
                <img src="img/people/3.png" alt="">
                <p><span>Emma Store</span>Senior marketing manager <br>Phone: + 000 123 000 <br> Email: jhin.due@hotmail.com</p>
            </div>
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