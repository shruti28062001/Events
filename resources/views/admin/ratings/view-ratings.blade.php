<?php $email = session('adminSession'); ?>

@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Ratings Section <span class="small badge badge-primary"></span></h4>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block w-50">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block w-50">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped" style="overflow-x: auto;">
                                <thead>
                                    <tr>
                                        <th>Sr.No</th>
                                        <th>Event Name</th>
                                        <th>Average Rating</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($averageRatings as $averageRating)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>
                                        <td>{{ optional($averageRating->event)->name }}</td>
                                        <td>{{ number_format($averageRating->average_rating, 2) }}</td>
                                        <td>
                                            <a class="btn btn-default" id="editRating" href="{{ url('/admin/edit-ratings/'.$averageRating->event_id) }}" title="Edit Rating"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;&nbsp;
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
