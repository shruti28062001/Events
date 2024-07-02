@extends('layouts/adminLayout/admin_design')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h4>Edit Ratings</h4>
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
                        <li class="breadcrumb-item"><a href="{{ url('/admin/dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Ratings</li>
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
                        <form method="POST" action="{{ url('admin/edit-ratings/'.$ratings->id) }}" enctype="multipart/form-data" id="editRatings">@csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="required">Name</label>
                                        <select name="offerings_id" class="form-control" required>
                                            @foreach($events as $events)
                                                <option value="{{ $events->id }}" {{ $event->id == $ratings->events_id ? 'selected' : '' }}>{{ $events->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="required">Ratings</label>
                                        <input type="radio" name="stars" class="form-control" value="{{ $ratings->Ratings }}" placeholder="RAtings" required>
                                    </div>   
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary submit"><i class="fa fa-check-circle"></i> Update </button>
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
        $('#editExpertise').validate({
            ignore: [],
            debug: false,
            rules: {
                category_id: {
                    required: true,
                },
                title: {
                    required: true,
                    maxlength: 40,
                },
                description: {
                    required: true,
                    maxlength: required,
                },
            },
            messages: {
                title: {
                    required: "Please enter no more than {0} characters.",   
                },
                description: {
                    required: "Please enter no more than {0} characters.",   
                },
            },
            submitHandler: function(form) {
                $(".submit").attr("disabled", true);
                $(".submit").html("<span class='fa fa-spinner fa-spin'></span> Please wait...");
                form.submit();
            }
        });
    });
</script>
