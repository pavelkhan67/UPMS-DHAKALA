@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'GetTradeLicense'])
@push('style')
@endpush
@section('title', 'Organization Trade License Create')
@section('content')
   <!-- Content Header (Page header) -->
   <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Organization Trade License Create</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{route('organizationA.trade-license.index')}}">Organization Trade License</a></li>
            <li class="breadcrumb-item">Create</li>
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
                            <h3 class="card-title">Organization Trade License Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="feesFormTradeLicense" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Financial Year</th>
                                            <th>
                                                <select class="form-control" id="tax_year_id" name="tax_year_id">
                                                    <option value="">Select Financial Year</option>
                                                    @if ($tax_years)
                                                        @foreach ($tax_years as $tax_year)
                                                            <option value="{{ $tax_year->id }}">{{ $tax_year->name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <small class="error tax_year_id-error text-danger"></small>
                                            </th>
                                            <th>Organizaiton ID</th>
                                            <th>

                                                <div class="row input-group input-group-sm user_info">
                                                    <input type="text" name="system_id" id="system_id" placeholder="Search By Organization ID"  required class="form-control system_id">
                                                    <span class="input-group-append">
                                                      <button type="button" class="btn btn-info btn-flat find_organization_info"><i class="fa fa-search"></i></button>
                                                    </span>
                                                </div>
                                                <span class="error system_id-error text-danger"></span>

                                            </th>
                                        </tr>
                                    </thead>
                                </table>


                                <div class="load-trade-license">

                                </div>

                               

                                
                               


                            </div>
                            <!-- /.card-body -->
                            
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
         
        $(document).on('submit', '#feesFormTradeLicense', function(e){
            e.preventDefault();
            let thisForm = $(this);
            $.ajax({
                type: "POST",
                url: "{{route('organizationA.trade-license.store')}}",
                data: new FormData(this),
                dataType: "json",
                contentType:false,
                cache:false,
                processData:false,
                beforeSend: function() {
                    thisForm.find('button[type="submit"]').prop("disabled",true);
                },
                success: function (response) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    toastr.success(response.message);
                    setTimeout(function() {
                        location.href = response.redirect_url;
                    }, 2000)
                },
                error: function(xhr, status, error) {
                    thisForm.find('button[type="submit"]').prop("disabled",false);
                    var responseText = jQuery.parseJSON(xhr.responseText);
                    toastr.error(responseText.message);
                    $.each(responseText.errors, function(key, val) {
                        thisForm.find("." + key + "-error").text(val[0]);
                    });
                }
            });
        })

        $(document).on('click', '.find_organization_info', function(e){
            e.preventDefault();
            $(".system_id-error").text("");
            let _this_btn = $(this);
            let system_id = $("#system_id").val();
            if(system_id){
                $.ajax({
                    type: "GET",
                    url: "{{url('/')}}/get-organization-info-by-system-id/"+system_id,
                    beforeSend: function() {
                        _this_btn.prop("disabled",true);
                        $(".organization_name").text('');
                        $(".organization_address").text('');
                    },
                    success: function (response) {
                        _this_btn.prop("disabled",false);
                        toastr.success(response.message);
                        $(".organization_id").val(response.organization.id);
                        $(".organization_name").text(response.organization_name);
                        $(".organization_address").text(response.organization_address);

                        findFees(response.organization.id);
                    },
                    error: function(xhr, status, error) {
                        _this_btn.prop("disabled",false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            }else{
                $(".system_id-error").text("Organzition ID is required!")
            }
        })

    </script>
@endpush
