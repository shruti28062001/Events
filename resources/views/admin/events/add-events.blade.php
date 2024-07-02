@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h4>Events Section</h4> 
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
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/admin/dashboard') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Events</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Events</h3>
                        </div>
                        <form method="POST" action="{{ url('admin/add-events') }}" enctype="multipart/form-data" id="addBanner">@csrf 
                            <div class="card-body">
                                <div class="form-group col-md-10">
                                    <div class="form-group col-md-10">
                                        <label class="required"> Image <small>(Size: 54X54px)</small></label>
                                        <input type="file" name="image" class="form-control" accept="image/*" required>
                                        <small>Note: Image size should be less than 500KB</small>
                                    </div>
                                </div>
                                <div class="form-group col-md-10">
                                    <div class="form-group col-md-10">
                                        <label class="required">Name</label>
                                        <input name="name" class="form-control" placeholder="Enter Name" required>
                                    </div>
                                </div>
                                <div class="form-group col-md-10">
                                    <div class="form-group col-md-10">
                                        <label class="required">Location</label>
                                        <input name="location" class="form-control" placeholder="Enter Location" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer ">
                                <button type="submit" class="btn btn-primary submit">
                                    <i class="fa fa-check-circle"></i> Add </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script src="{{ asset('backend_plugins/jquery/jquery.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#addBanner').validate({
            ignore: [],
            debug: false,
            rules: {
                content: {
                    required: true,
                },
                image: {
                    required: true,
                    accept: 'png|jpg|jpeg|webp',
                },
                
            },
            messages: {},
            submitHandler: function(form) {
                $(".submit").attr("disabled", true);
                $(".submit").html("<span class='fa fa-spinner fa-spin'></span> Please wait...");
                form.submit();
            }
        });
    });
</script>
@endsection