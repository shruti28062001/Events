<?php $email = session('adminSession'); ?>
@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Events</h4>
                </div>
                <div class="col-sm-6 text-right">
                    <a href="{{ url('/admin/add-events') }}" class="btn btn-primary"><i class="fa fa-plus-circle"></i> Events</a>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if(Session::has('flash_message_error'))
                    <div class="alert alert-danger alert-block">
                        <button type="button" class="close" data-dismiss="alert">×</button>
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>
                    @endif
                    @if(Session::has('flash_message_success'))
                    <div class="alert alert-success alert-block">
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
                                        <th>Image</th>                    
                                        <th>Name</th>
                                        <th>Location</th>
                                        <th>Update At</th>                                        
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($events as $row)
                                    <tr>
                                        <td>{{ $loop->index+1 }}</td>
                                        <td><a href="{{ asset('assets/imgs/events/'.$row->image) }}"><img src="{{ asset('assets/imgs/events/'.$row->image) }}" width="100px"></a></td>                                         
                                        <td>{!! Str::limit($row->name,20)!!}</td>                                         
                                        <td>{!! Str::limit($row->location,20)!!}</td>
                                        <td>{{date('d F Y', strtotime($row->updated_at)) }}</td>
                                        <td>
                                            <a class="btn btn-default"  id="editAbout" href="{{ url('/admin/edit-events/'.$row->id) }}" title="Edit Events"><i class="fa fa-edit" style="color: #000;"></i></a> &nbsp;&nbsp;
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