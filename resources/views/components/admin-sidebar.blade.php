{{-- admin-sidebar.blade.php --}}
<div class="col-md-3 col-lg-2 p-0 d-flex flex-column" id="sidebar" style="height: 100%;">

    {{-- Encabezado fijo --}}
    <div class="p-3 border-bottom">
        <h5>Administrador</h5>
    </div>

    {{-- Navegación --}}
    <ul class="nav flex-column p-3 flex-grow-1 overflow-auto" id="sidebarMenu">

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.usuarios*') ? 'active fw-semibold' : '' }}"
               href="{{ route('admin.usuarios') }}">
                Gestión de Usuarios
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.locales*') ? 'active fw-semibold' : '' }}"
               href="{{ route('admin.locales') }}">
                Gestión de Locales
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('promociones*') ? 'active fw-semibold' : '' }}"
               href="{{ route('promociones') }}">
                Gestión de Promociones
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.novedades*') ? 'active fw-semibold' : '' }}"
               href="{{ route('admin.novedades') }}">
                Gestión de Novedades
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reporte*') ? 'active fw-semibold' : '' }}"
               href="{{ route('admin.reporte') }}">
                Reporte
            </a>
        </li>
        

    </ul>
</div>