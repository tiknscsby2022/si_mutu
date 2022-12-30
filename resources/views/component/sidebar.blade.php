<div class="uk-width-1-4@s">
    <div class="uk-height-large uk-card uk-card-default uk-card-body" uk-height-viewport="expand: true">        
        <ul class="uk-nav uk-nav-default" uk-nav>
            @if($user->is_admin == true)
                <li class="uk-nav-header uk-text-center">Simutu</li>  
                <li class="uk-nav-divider"></li>              
                <li class="{{ (request()->is('beranda')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_beranda_show') }}"><span class="uk-margin-small-right" uk-icon="home"></span> Dashboard</a>                
                </li>    
                <li class="{{ (request()->is('penetapan')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_penetapan_show') }}"><span class="uk-margin-small-right" uk-icon="tag"></span> Penetapan</a>                
                </li>   
                <li class="{{ (request()->is('realisasi')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_realisasi_show') }}"><span class="uk-margin-small-right" uk-icon="link"></span> Realisasi</a>                
                </li>                
                <li class="{{ (request()->is('temuan')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_temuan_show') }}"><span class="uk-margin-small-right" uk-icon="settings"></span> Temuan dan Rekomendasi</a>                
                </li>                
                <li class="{{ (request()->is('pengendalian')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_pengendalian_show') }}"><span class="uk-margin-small-right" uk-icon="commenting"></span> Rapat Tinjauan</a>                
                </li> 
                <li class="{{ (request()->is('peningkatan')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('admin_peningkatan_show') }}"><span class="uk-margin-small-right" uk-icon="gitter"></span> Peningkatan</a>                
                </li>                
                <li class="{{ (request()->is('user')) ? 'uk-active' : '' }}">                    
                    <a href="#"><span class="uk-margin-small-right" uk-icon="users"></span> Pengguna</a>                
                </li>                
                <li class="{{ (request()->is('setting')) ? 'uk-active' : '' }}">                    
                    <a href="#"><span class="uk-margin-small-right" uk-icon="cog"></span> Pengaturan</a>                
                </li>                                
                <li><a href="{!! route('logout') !!}"><span class="uk-margin-small-right"  uk-icon="sign-out"></span> Keluar</a></li>  
            @else
                <li class="uk-nav-header uk-text-center">Simutu</li>  
                <li class="uk-nav-divider"></li>              
                <li class="{{ (request()->is('dashboard')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('user_dashboard_show') }}"><span class="uk-margin-small-right" uk-icon="home"></span> Dashboard</a>                
                </li>    
                <li class="{{ (request()->is('realisasi')) ? 'uk-active' : '' }}">                    
                    <a href="{{ route('user_realisasi_show', ['name'=>$user->role]) }}"><span class="uk-margin-small-right" uk-icon="link"></span> Realisasi</a>                
                </li>
            @endif
        </ul>
    </div>
</div>