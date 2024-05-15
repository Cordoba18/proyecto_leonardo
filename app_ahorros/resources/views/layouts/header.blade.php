<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand" href="{{ route('inicio')}}">SERVICIO SISTEMATIZADO DE AHORRO</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-house"></i> INICIO
                </a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="#"><i class="bi bi-wallet2"></i> Tarjetas</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-bar-chart"></i>Movimientos de usuario</a></li>
                  <li><a class="dropdown-item" href="#"><i class="bi bi-wallet"></i> Metas de ahorro</a></li>
                </ul>
              </li>
          </li>

        </ul>
        <span class="navbar-text">
          <a href="{{route('logout')}}" class="btn btn-outline-danger"><i class="bi bi-box-arrow-right"></i> CERRAR SESIÓN</a>
        </span>
      </div>
    </div>
  </nav>
