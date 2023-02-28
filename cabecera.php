<header><? $current='<span class="sr-only">(current)</span>';?>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top my-nav">
 
  <!-- Acá cambié el titulo de por una imagen "Valiticket" -->
  <a href="index.php" class="my-logo-a">
    <img src="./imgs/valilogocopia.png" alt=""  class="my-logo-img" href="index.php">
  </a>

    
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>


    <div class="collapse navbar-collapse" id="navbarCollapse">

      <!-- a los componentes "a" les agregué "style" con condiciones php -->

      <ul class="navbar-nav ml-auto">
        <li class="my-li">
          <a  class="my-a <? if ($portada!=1) echo "my-bottom-line-a";?>" href="index.php" style="<? if ($portada==1) echo "color:#daff06; border-bottom:3px solid #daff06; ";?>">Portada</a>
        </li>
        <li class="my-li move">
          <a   class="  my-a  <? if ($eventos!=1) echo "my-bottom-line-a";?>" href="eventos.php" style="<? if ($eventos==1) echo "color:#daff06; border-bottom:2px solid #daff06; ";?>">Eventos</a>
        </li>
        <li class="my-li">
          <a   class="my-a   <? if ($servicios!=1) echo "my-bottom-line-a";?>" href="servicios.php" style="<? if ($servicios==1) echo "color:#daff06; border-bottom:2px solid #daff06; ";?>">Servicios</a>
        </li>
        <?
		if (!isset($_SESSION['idu'])) {
		?>
		<li class="my-li">
          <a   class="my-a  <? if ($registro!=1) echo "my-bottom-line-a";?>" href="registro.php" style="<? if ($registro==1) echo "color:#daff06; border-bottom:2px solid #daff06; ";?>">Registrate</a>
        </li><? } ?>
        <li class="my-li">
        	<?
            if (!isset($_SESSION['idu'])) {
			?><a   class="my-a   <? if ($login!=1 or $miperfil!=1) echo "my-bottom-line-a";?>" href="login.php" style="<? if ($login==1 or $miperfil==1) echo "color:#daff06; border-bottom:2px solid #daff06; ";?>">Iniciar sesi&oacute;n</a><? } else {?>
          <a  class="my-a <? if ($login!=1 or $miperfil!=1) echo "my-bottom-line-a";?>" href="mi-perfil.php" >Mi perfil</a><? } ?>
        </li>
        <li class="my-li">
          <a  class="my-a <? if ($carrito!=1) echo "my-bottom-line-a";?>" href="cart.php" style="<? if ($carrito==1) echo "color:#daff06; border-bottom:2px solid #daff06; ";?>">Carrito</a>
        </li>
      </ul>

      <!-- EL BOTON PARA CAMBIAR TEMA AHORA SON ICONOS -->

      <div class="theme-toggle">
         <? if ($_SESSION['skin']=="dark") {?>


    <a href="?skin=white"><i  class="theme-toggle-icon-moon my-spin"></i></a>
    
	  <? } else {?>
	 
    <a  href="?skin=dark"><i class="theme-toggle-icon-sun my-spin"></i></a>
    
	  <? } ?>
      </div>


      <!-- Formulario -->
      <form class="my-form">
        <input class="my-input mr-sm-2" type="text" placeholder="Escribe aquí..." aria-label="Buscar">
        <button class="my-button" type="submit">Buscar</button>
      </form>

    </div>
  </nav>

  <div class="transition-overlay">
		<!-- <div class="spinner"></div> -->
    <img src="./imgs/logo.jpg"  class="arrow">
 
	</div>



  <!-- ESTILOS AGREGADOS  Y SCRIPTS -->

  <script>
  $(document).ready(function() {
    $('.move').hover(function() {
      $(this).addClass('move-animate');
    }, function() {
      $(this).removeClass('move-animate');
    });
  });
</script>

<!-- nuevo script -->

<script type="text/javascript">
		
		function goToPage(event) {
			event.preventDefault();
			
			document.querySelector('.transition-overlay').style.display = 'flex';

		
			setTimeout(function() {
			
				window.location.href = event.target.href;
			}, 2000);
		}

	
		var buttons = document.querySelectorAll('.my-a');
		for (var i = 0; i < buttons.length; i++) {
			buttons[i].onclick = goToPage;
		}
	</script>


<!-- fin del script -->



<style>

/* ESTILOS PARA PANTALLA DE CARGA comienzo*/
.transition-overlay {
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: #3b0082;
	z-index: 9999;
	display: none;
	align-items: center; 
}

/* logo de Valiticket se desliza de izquierda a derecha */
.arrow {
  position: absolute;
  transform: translateY(-50%);
  width: 300px;
  height:300px;
  animation: moveRight 2s ease-in-out infinite;
}

/* animación de carga para .arrow */
@keyframes moveRight {
  0% {
    transform: translateX(-100%);
  }
  100% {
    transform: translateX(600%);
  }
 
}
/* ESTILOS PARA PANTALLA DE CARGA fin */




/* ESTILOS TOPBAR comienzo */
.my-nav{
background-color:<?php echo $_SESSION['skin']=="dark" ? "#050c40" :  "#3b0082"?>
}

/* esto es el tag <a> que envuelve al Logo <img/> para que redirija al clickear. */
.my-logo-a {
  width:20%; 
  height:20%;
  margin-right:30px
}

/* acá colocamos un margin desde los componentes <li> */
.my-li{
  margin-right:20px
}

/* este es el logo que está dentro del tag <a> */
.my-logo-img {
  width:100%;
  height:100%;
}
/* ESTILOS TOPBAR fin */



/* ESTILOS PARA LA NAVEGACIÓN EN LA TOPBAR comienzo */

/* componentes <a> de la tobar dentro del componente <ul> */
  .my-a {
    margin:0;
    padding:0;
    font-size:19px;
    font-family: 'Oswald', sans-serif;
    color:#bab9b6;
  }

  /* su hover, cambia el color de la fuente */
  .my-a:hover {
  color:#daff06 !important;
  }

  /* clase ESPECIAL para detectar el componente <a>Eventos<a/> */
  .move {
  position: relative;
  }
 

  /* efecto movimiento para el componente <a>Eventos<a/> */
  .move-animate {
    animation-duration: 0.5s;
    animation-name: move;
    animation-direction: alternate;
    animation-iteration-count: infinite;
    animation-timing-function: ease-in-out;
  }

  /* animación que agregamos en la clase .move-animate */
  @keyframes move {
  0% {
    transform: translateY(0) ;
  }

  50% {
    transform: translateY(-10px) ;
    animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
  100%{
    transform: translateY(0);
    animation-timing-function: cubic-bezier(0.25, 0.46, 0.45, 0.94);
  }
}

  /* efecto especial para los componentes <a> que están dentro de <ul> */
  .my-bottom-line-a {
  position: relative;
  text-decoration: none;
  }

  .my-bottom-line-a::after {
    width: 0;
    height: 2px;
    bottom: -2px;
    left: 0;
    transition: width 0.3s ease-in-out;
    content: '';
    display: block;
    position: absolute;
    background-color: #daff06;
}

.my-bottom-line-a:hover::after {
  width: 100%;
}

.my-bottom-line-a.active::after {
  width: 100%;
}
/*ESTILOS PARA LA NAVEGACIÓN EN LA TOPBAR fin*/



/* ESTILOS PARA TOGGLE DE CAMBIO DE TEMA comienzo*/

/* definimos el container */
  .theme-toggle {
    width: 24px;
    height: 24px;
    margin-right:20px;
    display: inline-block;
    cursor: pointer;
  }

  /* icono luna */
  .theme-toggle-icon-moon {
    width: 100%;
    height: 100%;
    display: block;
    background-image: url('./imgs/moon.png');
    background-size: cover;
  }
 
  /* icono sol */
  .theme-toggle-icon-sun {
    width: 100%;
    height: 100%;
    display: block;
    background-image: url('./imgs/sun.png');
    background-size: cover;
  }
    /* efecto de "giro" al clickear definimos una clase especial llamada .my-spin */
  .my-spin {
    transition: transform 0.5s;
  }

  .my-spin:hover{
    transform: rotateY(180deg);
  }
  /* ESTILOS PARA TOGGLE DE CAMBIO DE TEMA fin*/


/* ESTILOS PARA EL FOMULARIO comienzo */

  /* acá definimos el container del formulario */
  .my-form{
  width:30%;
  padding:0;
  margin-left:auto;
  display:flex;
  flex-direction:row
  }

/* estilos del input */
  .my-input{
    width:200px;
    height: 40px;
    margin-left:10px;
    font-size:19px;
    font-family: 'Oswald', sans-serif;
  }

/* a partir de acá tenemos los estilos que usamos en los botones */
  .my-button {
    width:100%;
    height: 40px;
    max-width: 200px;
    padding-left: 16px;
    padding-right: 16px;
    border-radius: 4px;
    border-width: 0;
    font-size: 18px;
    line-height: 1;
    box-shadow: rgba(45, 35, 66, 0.4) 0 2px 4px,rgba(45, 35, 66, 0.3) 0 7px 13px -3px,#D6D6E7 0 -3px 0 inset;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: left;
    appearance: none;
    box-sizing: border-box;
    font-family: 'Oswald', sans-serif;
    cursor: pointer;
    list-style: none;
    overflow: hidden;
    position: relative;
    text-decoration: none;
    user-select: none;
    -webkit-user-select: none;
    touch-action: manipulation;
    white-space: nowrap;
    background-color: #FCFCFD;
    color: #36395A;
    transition: box-shadow .15s,transform .15s;
    will-change: box-shadow,transform;
  }

  .my-button:focus {
  box-shadow: #D6D6E7 0 0 0 1.5px inset, rgba(45, 35, 66, 0.4) 0 2px 4px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  }

  .my-button:hover {
  box-shadow: rgba(45, 35, 66, 0.4) 0 4px 8px, rgba(45, 35, 66, 0.3) 0 7px 13px -3px, #D6D6E7 0 -3px 0 inset;
  transform: translateY(-2px);
  color: #9fba04
  }

  .my-button:active {
  box-shadow: #D6D6E7 0 3px 7px inset;
  transform: translateY(2px);
  }
/* ESTILOS PARA EL FOMULARIO fin */


  /* estilos responsives para pantallas chicas */
  @media (max-width: 768px) {
  .my-logo-a{
    width:50%;
    height:50%
    }
  }


/* estilos responsives para pantallas grandes */
  @media (max-width: 1227px) {
  .my-form{
    flex-direction:column;
    align-items:center
  }

  .my-button{
    width: auto;
    max-width: none;
  }

  .my-logo-a{
    width:200px; 
    height:20%;
    margin-right:30px
  }

}


 </style>
</header>