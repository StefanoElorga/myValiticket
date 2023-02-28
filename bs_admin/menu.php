<nav class="navbar navbar-expand-lg navbar-light bg-light">

  <a class="navbar-brand" href="index.php">Inicio</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">

    <span class="navbar-toggler-icon"></span>

  </button>



  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-auto">

       <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          Sistema

        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			<? if ($_SESSION['cusuario']=='1') {?><a class="dropdown-item" href="usuarios.php">Usuarios de admin</a>
			<? } ?>

          <a class="dropdown-item" href="cpass.php">Cambiar contraseña</a>

          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="logout.php">Salir del sistema</a>

        </div>

      </li>

    <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          Personas

        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="listado-personas.php">Listado Alfabético</a>
        </div>

      </li>

      <li class="nav-item dropdown">

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          Eventos

        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item" href="listado-eventos.php">Listado Eventos en curso</a>

<!--		  <a class="dropdown-item" href="ordenar-seccionesp.php">Ordenar</a>-->
          <a class="dropdown-item" href="listado-eventos.php?aprobados=0&search=">Para aprobar</a>
<!--            <form class="form-inline my-2 my-lg-0">

              <input class="form-control mr-sm-2" type="search" placeholder="Buscar" aria-label="Buscar" name="search">

              <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>

            </form>
-->
        </div>

      </li>

    <li class="nav-item dropdown" style="display:none;">

        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

          Blog

        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown" >

          <a class="dropdown-item" href="#">Cargar nueva</a>

          <a class="dropdown-item" href="#">Listado de noticias</a>

        </div>

      </li>

    </ul>

  </div>

</nav>