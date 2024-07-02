@php
    $email = session('adminSession');
  
    use App\Models\Admin;
  
@endphp

@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
            </div>
        </div>
    </div> 

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{$events}}</h3>
                            <p>Events Details</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-map"></i>
                        </div>
                        <a href="view-events/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{$ratings}}</h3>
                            <p>Ratings</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-location"></i>
                        </div>
                        <a href="view-ratings/" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
               
                
            </div>
        </div>
    </section>

</div>
@endsection