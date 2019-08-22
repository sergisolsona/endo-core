<nav class="navbar-default navbar-static-side" role="navigation">
    <form id="logout-form" action="{{ url('/logout') }}" method="post">
        {{ csrf_field() }}
    </form>

    <div class="sidebar-collapse" style="width: auto; height: 100%;">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="profile-element">
                    <span>
                        <img class="@if($user)img-circle @else sidebar-logo @endif" @if($user)width="48" height="48"@else width="96"@endif alt="Endo" src="{{ asset('vendor/endo/imgs/' . $user->avatar) }}">
                    </span>
                    @if ($user)
                        <div>
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#" aria-expanded="false">
                                <span class="clear">
                                    <span class="block m-t-xs"> <strong class="font-bold">{{ $user->name }}</strong></span>
                                    <span class="text-muted text-xs block">{{ $user->endoRole->name }} <b class="caret"></b></span>
                                </span>
                            </a>

                            <ul class="dropdown-menu animated fadeInDown m-t-xs">
                                {{--<li class="divider"></li>--}}
                                <li>
                                    {{--<a href="#" onclick="$('#logout-form').submit();" title="Logout">Cerrar sesión</a>--}}
                                    <a href="{{ url('/logout') }}" title="Logout">Logout</a>
                                </li>
                            </ul>
                        </div>
                    @endif
                </div>
            </li>

            {{--<li @if(strpos(route_name(), 'dashboard')  !== false)class="active"@endif>
                <a class="js-click" title="Dashboard" href="{{ route('dashboard', []) }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li>

            @can('view', 'operations.')
                <li @if(strpos(route_name(), 'operations.')  !== false)class="active"@endif>
                    <a class="js-click" title="Operaciones" href="{{ route('operations.index', []) }}"><i class="fa fa-eye"></i> <span class="nav-label">Operaciones</span></a>
                </li>
            @endcan

            @can('view', 'productos.')
                <li @if(strpos(route_name(), 'productos.')  !== false)class="active"@endif>
                    <a class="js-click" title="Productos" href="{{ route('productos.index', []) }}"><i class="fa fa-shopping-bag"></i> <span class="nav-label">Productos</span></a>
                </li>
            @endcan

            @can('view', 'planner.')
                <li @if(strpos(route_name(), 'planner.')  !== false)class="active"@endif>
                    <a class="js-click" title="Planificador" href="{{ route('planner.index', []) }}"><i class="fa fa-calendar"></i> <span class="nav-label">Planificador</span></a>
                </li>
            @endcan

            @can('view', 'pedidos.')
                <li @if(strpos(route_name(), 'pedidos.')  !== false)class="active"@endif>
                    <a class="js-click" title="Pedidos" href="{{ route('pedidos.index', []) }}"><i class="fa fa-comments"></i> <span class="nav-label">Pedidos</span></a>
                </li>
            @endcan

            @can('view', 'cupones.')
                <li @if(strpos(route_name(), 'cupones.') !== false)class="active"@endif>
                    <a class="js-click" title="Cupones" href="{{ route('cupones.index', []) }}"><i class="fa fa-tags"></i> <span class="nav-label">Cupones</span></a>
                </li>
            @endcan

            @can('view', 'usuarios.')
                <li @if(strpos(route_name(), 'usuarios.') !== false)class="active"@endif>
                    <a class="js-click" title="Usuarios" href="{{ route('usuarios.index', []) }}"><i class="fa fa-users"></i> <span class="nav-label">Usuarios</span></a>
                </li>
            @endcan

            @can('view', 'invoices.')
                <li @if(strpos(route_name(), 'invoices.') !== false)class="active"@endif>
                    <a class="js-click" title="Facturas" href="{{ route('invoices.index', []) }}"><i class="fa fa-list"></i> <span class="nav-label">Facturas</span></a>
                </li>
            @endcan

            @can('view', 'actions.')
                <li @if(strpos(route_name(), 'actions.') !== false)class="active"@endif>
                    <a class="js-click" title="Acciones" href="{{ route('actions.index', []) }}"><i class="fa fa-magic"></i> <span class="nav-label">Acciones</span></a>
                </li>
            @endcan

            @can('view', 'informes.')
                <li @if(strpos(route_name(), 'informes.') !== false)class="active"@endif>
                    <a href="#">
                        <i class="fa fa-area-chart"></i> <span class="nav-label">Informes</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse @if(route_name('informes.'))in @endif">
                        @can('view', 'informes.business.')
                            <li @if(strpos(route_name(), 'informes.business') !== false)class="active"@endif>
                                <a href="#">Business<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.business'))in @endif">
                                    <li @if(route_name('informes.business.invoicing'))class="active"@endif><a class="js-click" href="{{ route('informes.business.invoicing') }}">Facturación</a></li>
                                    <li @if(route_name('informes.business.pay-methods'))class="active"@endif><a class="js-click" href="{{ route('informes.business.pay-methods') }}">Tipo pago</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.marketing.')
                            <li @if(strpos(route_name(), 'informes.marketing') !== false)class="active"@endif>
                                <a href="#">Marketing<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.marketing'))in @endif">
                                    <li @if(strpos(route_name(), 'informes.marketing.clients-down') !== false)class="active"@endif><a class="js-click" href="{{ route('informes.marketing.clients-down') }}">Bajas clientes</a></li>
                                    <li @if(route_name('informes.marketing.buys-by-client'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.buys-by-client') }}">Compras x cliente</a></li>
                                    <li @if(route_name('informes.marketing.coupons'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.coupons') }}">Cupones</a></li>
                                    <li @if(route_name('informes.marketing.used-coupons'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.used-coupons') }}">Cupones usados</a></li>
                                    <li @if(route_name('informes.marketing.funnel'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.funnel') }}">Funnel</a></li>
                                    <li @if(route_name('informes.marketing.platform-report'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.platform-report') }}">Informe dispositivos</a></li>
                                    <li @if(route_name('informes.marketing.new-addresses'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.new-addresses') }}">Nuevas direcciones</a></li>
                                    <li @if(route_name('informes.marketing.new-clients'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.new-clients') }}">Nuevos clientes</a></li>
                                    <li @if(route_name('informes.marketing.b2b-opportunities'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.b2b-opportunities') }}">Oportunidades B2B</a></li>
                                    <li @if(route_name('informes.marketing.pedidos_marketing'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.pedidos_marketing') }}">Pedidos marketing</a></li>
                                    <li @if(route_name('informes.marketing.clients-users'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.clients-users') }}">Usuarios/Clientes</a></li>
                                    <li @if(route_name('informes.marketing.utms'))class="active"@endif><a class="js-click" href="{{ route('informes.marketing.utms') }}">Canales de atribución</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.metrics.')
                            <li @if(strpos(route_name(), 'informes.metrics') !== false)class="active"@endif>
                                <a href="#">Métricas<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.metrics'))in @endif">
                                    <li @if(route_name('informes.metrics.cmi-day'))class="active"@endif><a class="js-click" href="{{ route('informes.metrics.cmi-day') }}">CMI día</a></li>
                                    <li @if(route_name('informes.metrics.cmi-month'))class="active"@endif><a class="js-click" href="{{ route('informes.metrics.cmi-month') }}">CMI mes</a></li>
                                    <li @if(route_name('informes.metrics.cmi-accumulated'))class="active"@endif><a class="js-click" href="{{ route('informes.metrics.cmi-accumulated') }}">CMI acumulado</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.operaciones.')
                            <li @if(strpos(route_name(), 'informes.operaciones') !== false)class="active"@endif>
                                <a href="#">Operaciones<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.operaciones'))in @endif">
                                    <li @if(route_name('informes.operaciones.intervalos'))class="active"@endif><a class="js-click" href="{{ route('informes.operaciones.intervalos') }}">Intervalos</a></li>
                                    <li @if(route_name('informes.operaciones.retrasos'))class="active"@endif><a class="js-click" href="{{ route('informes.operaciones.retrasos') }}">Retrasos</a></li>
                                    <li @if(route_name('informes.operaciones.projections'))class="active"@endif><a class="js-click" href="{{ route('informes.operaciones.projections') }}">Proyecciones</a></li>
                                    <li @if(route_name('informes.operaciones.health'))class="active"@endif><a class="js-click" href="{{ route('informes.operaciones.health') }}">Sanidad</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.planificacion.')
                            <li @if(strpos(route_name(), 'informes.planificacion') !== false)class="active"@endif>
                                <a href="#">Planificación<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.planificacion'))in @endif">
                                    <li @if(route_name('informes.planificacion.dishes-surveys'))class="active"@endif><a class="js-click" href="{{ route('informes.planificacion.dishes-surveys') }}">Encuestas platos</a></li>
                                    <li @if(route_name('informes.planificacion.exito_productos'))class="active"@endif><a class="js-click" href="{{ route('informes.planificacion.exito_productos') }}">Éxito planificación</a></li>
                                    <li @if(route_name('informes.planificacion.historic_dishes'))class="active"@endif><a class="js-click" href="{{ route('informes.planificacion.historic_dishes') }}">Histórico platos</a></li>
                                    <li @if(route_name('informes.planificacion.menu_engineering'))class="active"@endif><a class="js-click" href="{{ route('informes.planificacion.menu_engineering') }}">Menu engineering</a></li>
                                    <li @if(route_name('informes.planificacion.desserts_engineering'))class="active"@endif><a class="js-click" href="{{ route('informes.planificacion.desserts_engineering') }}">Postres engineering</a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.sells.')
                            <li @if(strpos(route_name(), 'informes.sells') !== false)class="active"@endif>
                                <a href="#">Ventas<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.sells'))in @endif">
                                    <li @if(route_name('informes.sells.surveys'))class="active"@endif><a class="js-click" href="{{ route('informes.sells.surveys') }}">Encuestas</a></li></a></li>
                                </ul>
                            </li>
                        @endcan

                        @can('view', 'informes.consumer-habits.')
                            <li @if(strpos(route_name(), 'informes.consumer-habits') !== false)class="active"@endif>
                                <a href="#">Hábitos de consumo<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'informes.consumer-habits'))in @endif">
                                    <li @if(route_name('informes.consumer-habits.user-likes'))class="active"@endif><a class="js-click" href="{{ route('informes.consumer-habits.user-likes') }}">Preferencias platos</a></li>
                                    <li @if(route_name('informes.consumer-habits.user-time-habits'))class="active"@endif><a class="js-click" href="{{ route('informes.consumer-habits.user-time-habits') }}">Horario pedidos</a></li>
                                    <li @if(route_name('informes.consumer-habits.user-week-habits'))class="active"@endif><a class="js-click" href="{{ route('informes.consumer-habits.user-week-habits') }}">Pedidos semana</a></li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('view', 'enterprises.')
                <li @if(strpos(route_name(), 'enterprises.') !== false)class="active"@endif>
                    <a href="#">
                        <i class="fa fa-handshake-o"></i> <span class="nav-label">Enterprise</span><span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level collapse @if(route_name('enterprises.index'))in @endif">
                        <li @if(strpos(route_name(), 'enterprises.index') !== false)class="active"@endif><a class="js-click" href="{{ route('enterprises.index') }}">Empresas</a></li>

                        @can('view', 'enterprises.reports.')
                            <li @if(strpos(route_name(), 'enterprises.reports') !== false)class="active"@endif>
                                <a href="#">Informes<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse @if(strpos(route_name(), 'enterprises.reports'))in @endif">
                                    <li @if(strpos(route_name(), 'enterprises.reports.activations') !== false)class="active"@endif><a class="js-click" href="{{ route('enterprises.reports.activations') }}">Activaciones</a></li>
                                    <li @if(strpos(route_name(), 'enterprises.reports.gamification') !== false)class="active"@endif><a class="js-click" href="{{ route('enterprises.reports.gamification') }}">Gamificación</a></li>
                                    <li @if(strpos(route_name(), 'enterprises.reports.ranking') !== false)class="active"@endif><a class="js-click" href="{{ route('enterprises.reports.ranking') }}">Ranking</a></li>
                                </ul>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcan

            @can('view', 'admin.')
                <li @if(strpos(route_name(), 'admin.')  !== false)class="active"@endif>
                    <a class="js-click" title="Administrar BO2" href="{{ route('admin.index', []) }}"><i class="fa fa-cogs"></i> <span class="nav-label">Admin BO2</span></a>
                </li>
            @endcan--}}
        </ul>
    </div>
</nav>
