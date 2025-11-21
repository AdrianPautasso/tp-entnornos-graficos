{{-- admin-sidebar.blade.php --}}
<div class="col-md-3 col-lg-2 p-0 d-flex flex-column" id="sidebar" style="height: 100%;">
    {{-- Encabezado fijo --}}
    <div class="p-3 border-bottom">
        <h5>Dueño Negocio</h5>
    </div>
    {{-- Contenido de la navegación, que puede tener su propio scroll si excede --}}
    <ul class="nav flex-column p-3 flex-grow-1 overflow-auto" id="sidebarMenu">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('promociones') }}">Gestión de Promociones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dueno.gestionUsoPromociones') }}">Gestión Uso de Promociones</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('usoPromociones') }}">Ver Uso de Promociones</a>
        </li>
        
        {{-- Agrega más opciones aquí --}}
        
        {{-- Puedes añadir muchos más ítems aquí para probar el scroll --}}
    </ul>
</div>