
<div id="" class="side-nav fixed p-0 pt-3" style="background: none; box-shadow: none;">
    <div class="mt-5 pb-5" style="background: black; border-radius: 16px;  box-shadow: 1px 1px 10px rgba(0, 0, 0, 0.291);">
        <ul class="custom-scrollbar" style="">
            <li class="logo-sn waves-effect py-3">
                <div class="text-center">
                    <a href="{{ url('admin') }}">
                        <img class="img-fluid" src="{{asset('img/design/logo_woz.png')}}">
                    </a>
                </div>
            </li>
            <li>
                <ul class="collapsible collapsible-accordion">
                    <li class="p-2">
                        <a href="{{ route('admin.contacto') }}" class="collapsible-header waves-effect text-white fs-5 {{ (request()->is('contacto')) ? 'active' : '' }}" style="border-radius: 16px; text-decoration: none; "><i class="bi bi-gear-fill"></i> Configuración</a>
                    </li>
                    <li class="p-2">
                        <a href="{{ route('seccion.show', ['slug' => 'home'])}}" class="text-white fs-5" style="border-radius: 16px; text-decoration: none; " ><i class="bi bi-house-door-fill"></i> Adm. Home</a>
                    </li>
                    <li class="p-2">
                        <a href="{{ route('seccion.show', ['slug' => 'nosotros'])}}" class="text-white fs-5" style="border-radius: 16px; text-decoration: none; " ><i class="bi bi-house-door-fill"></i> Adm. Nosotros</a>
                    </li>
                    <li class="p-2">
                        <a href="{{ route('seccion.show', ['slug' => 'contacto'])}}" class="text-white fs-5" style="border-radius: 16px; text-decoration: none; " ><i class="bi bi-house-door-fill"></i> Adm. Contacto</a>
                    </li>
                    {{-- <li class="p-2"> --}}
                        {{-- <a href="{{ url('admin/config/') }}" class="collapsible-header waves-effect {{ (request()->is('admin/config')) ? 'active' : '' }}" style="border-radius: 16px; text-decoration: none; "><i class="w-fa fas fa-cog"></i>Configuración</a> --}}
                        {{-- <a href="{{ route('vacante.index') }}" class="collapsible-header waves-effect {{ (request()->is('admin/vacantes')) ? 'active' : '' }}" style="border-radius: 16px; text-decoration: none; "><i class="w-fa fas fa-search"></i>Vacantes</a>
                    </li> --}}
                </ul>
            </li>
        </ul>
    </div>
</div>
