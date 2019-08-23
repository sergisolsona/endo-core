<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-minimalize minimalize-styl-2 btn btn-primary "><i class="fa fa-bars"></i></a>

            @yield('menu_button')
        </div>
        <ul id="top_right" class="nav navbar-top-links navbar-right">
            <li >
                <a  href="{{ route('home') }}" target="_blank" aria-expanded="false">
                    <div class="text-info">{{ 'Endotest TODO' }} &nbsp;<i class="fa fa-external-link"></i></div>
                </a>
            </li>
        </ul>
    </nav>
</div>