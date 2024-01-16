@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' =>'CityCorporationWard'])
@push('style')
@endpush
@section('title', 'City Corporation Ward')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>City Corporation Ward</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('basic-settings.city-corporation-ward.index')}}">City Corporation Ward</a></li>
            <li class="breadcrumb-item active">Create</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- Main row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- Horizontal Form -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Edit City Corporation Ward Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="cityCorporationWardForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="en_ward_no" class="col-sm-2 col-form-label">Ward No <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="number" min="1" max="150" name="en_ward_no" placeholder="Ward No" class="form-control" id="en_ward_no" value="{{$ward->en_ward_no}}">
                                        <small class="text-danger error en_ward_no_error"></small>

                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_ward_no" class="col-sm-2 col-form-label">Ward No Bangla <span class="text-danger" data-toggle="tooltip" data-placement="top" title="Required">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="bn_ward_no" placeholder="Ward No Bangla" class="form-control" id="bn_ward_no" value="{{$ward->bn_ward_no}}">
                                        <small class="text-dange error bn_ward_no_error"></small>

                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{route('basic-settings.city-corporation-ward.index')}}" class="btn btn-default float-right">Cancel</a>
                                    <div class="col-sm-9">
                                        <button type="submit" class="btn btn-info">Update</button>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-footer -->
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

{{-- {{ route('death.store') }} --}}
@endsection
@push('script')

    <script>
         $(document).ready(function() {
             $(".select2").select2();
            $("#cityCorporationWardForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{route('basic-settings.city-corporation-ward.update', $ward->id)}}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType:false,
                    cache:false,
                    processData:false,
                    beforeSend: function() {
                        $('.error').text('');
                        thisForm.find('button[type="submit"]').prop("disabled",true);
                    },
                    success: function (response) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href = "{{route('basic-settings.city-corporation-ward.index')}}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })

    </script>
@endpush
