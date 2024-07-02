<?php $url = url()->current();?>

<aside class="main-sidebar elevation-4" style="background:#000000;color:white;">
    <a href="{{ url('/admin/dashboard') }}" class="brand-link text-white p-2" style="background:#000">
        <img src="{{asset('assets/imgs/events.svg')}}" class="brand-image" style="width:80%;">
    </a>
    <div class="sidebar">        
        <nav class="mt-1">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item has-treeview menu-open">
                    <a href="{{ url('/admin/dashboard') }}" class="nav-link text-white @if(preg_match('#/admin/dashboard#',$url)) active @endif">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/view-events')}}" class="nav-link text-white ">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Events Details</p>
                    </a>
                </li>   
                
                <li class="nav-item">
                    <a href="{{url('/admin/view-ratings/')}}" class="nav-link text-white @if(preg_match('/ratings/', $url)) active @endif">
                        <i class="nav-icon fas fa-user-cog"></i> Ratings
                    </a>
                </li>  
            </ul>
        </nav>  
    </div>
</aside>