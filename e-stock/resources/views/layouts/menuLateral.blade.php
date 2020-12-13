<link href="{{ asset('css/menuLateral.css') }}" rel="stylesheet">

<div id="lateral">

    <div id="enlaces">

        <a href="{{ url('/empresas/'.$empresa->id.'/inicio') }}" id="inicio"><div><i class="fa fa-home" aria-hidden="true"></i>Inicio</div></a>

        <a href="{{ url('/empresas/'.$empresa->id.'/productos') }}" id="productos"><div><i class="fa fa-shopping-basket" aria-hidden="true"></i>Productos</div></a>

        <a href="{{ url('/empresas/'.$empresa->id.'/categorias') }}" id="categorias"><div><i class="fa fa-list" aria-hidden="true"></i>Categorias</div></a>

        <a href="{{ url('/empresas/'.$empresa->id.'/proveedores') }}" id="proveedores"><div><i class="fa fa-truck" aria-hidden="true"></i>Proveedores</div></a>

        <a href="{{ url('/empresas/'.$empresa->id.'/listaCompra') }}" id="listaCompra"><div><i class="fa fa-pencil-square-o" aria-hidden="true"></i></i>Lista de la compra</div></a>

        <a href="{{ url('/empresas/'.$empresa->id.'/opciones') }}" id="opciones"><div><i class="fa fa-cog" aria-hidden="true"></i>Empresa</div></a>

        <a href="#" id="conexion"><div><i class="fa fa-plug" aria-hidden="true"></i>Conexión con PrestaShop</div></a>

    </div>

</div>

