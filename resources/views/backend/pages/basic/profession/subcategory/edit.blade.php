@extends('backend.master', ['mainMenu' => 'Basic', 'subMenu' => 'ProfessionSubcategory'])
@push('style')
@endpush
@section('title', 'Profession Subcategory')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profession Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('basic-settings.profession-subcategory.index') }}">Profession Subcategory</a>
                        </li>
                        <li class="breadcrumb-item active">Edit</li>
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
                            <h3 class="card-title">Edit Profession Subcategory Info</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form class="form-horizontal" id="professionSubcateogryEditForm" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">

                                <div class="form-group row">
                                    <label for="profession_id" class="col-sm-2 col-form-label">Profession <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="profession_id"
                                            id="profession_id">
                                            <option value="">Profession</option>
                                            @if ($professions)
                                                @foreach ($professions as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ isset($subcategory->category->type->profession->id) ? ($subcategory->category->type->profession->id == $item->id ? 'selected' : '') : '' }}>
                                                        {{ $item->en_name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                        <small class="error text-danger en_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profession_type_id" class="col-sm-2 col-form-label">Profession Type <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="profession_type_id"
                                            id="profession_type_id">
                                            <option value="{{ $subcategory->category->type->id ?? '' }}">
                                                {{ $subcategory->category->type->en_name ?? 'Profession Type' }}</option>
                                        </select>
                                        <small class="error text-danger en_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="profession_category_id" class="col-sm-2 col-form-label">Profession Category <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <select required class="form-control select2" name="profession_category_id"
                                            id="profession_category_id">
                                            <option value="{{ $subcategory->category->id ?? '' }}">
                                                {{ $subcategory->category->en_name ?? 'Profession Category' }} </option>
                                        </select>
                                        <small class="error text-danger en_name_error"></small>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="en_name" class="col-sm-2 col-form-label">Subcategory <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="en_name" value="{{ $subcategory->en_name }}"
                                            placeholder="Profession Subcategory" class="form-control" id="en_name">
                                            <small class="error text-danger en_name_error"></small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="bn_name" class="col-sm-2 col-form-label">Subcategory Bangla <span class="text-danger" title="Required" data-toggle="tooltip">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" required name="bn_name" value="{{ $subcategory->bn_name }}"
                                            placeholder="Profession Subcategory Bangla" class="form-control"
                                            id="bn_name">
                                            <small class="error text-danger bn_name_error"></small>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <div class="form-group row">
                                    <a href="{{ route('basic-settings.profession-subcategory.index') }}"
                                        class="btn btn-default float-right">Cancel</a>
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

@endsection
@push('script')
    <script>
        $(document).ready(function() {
            $(".select2").select2();
            $("#professionSubcateogryEditForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('basic-settings.profession-subcategory.update', $subcategory->id) }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                        $('.error').text();
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        setTimeout(function() {
                            location.href =
                                "{{ route('basic-settings.profession-subcategory.index') }}";
                        }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "_error").text(val[0]);
                        });
                    }
                });
            })
        })


        $(document).on('change', '#profession_id', function(e) {
            e.preventDefault();
            let profession_id = $(this).val();
            let option = '<option value="">Select Profession Type</option>';
            let profession_type = $("#profession_type_id");

            if (profession_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profession-type-options-by-profession') }}/" + profession_id,
                    beforeSend: function() {
                        console.log("Searcing...");
                        profession_type.html(option);
                    },
                    success: function(response) {
                        profession_type.html(response);
                    },
                    error: function(xhr, status, error) {
                        profession_type.html(option);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                profession_type.html(option);
            }
        })

        $(document).on('change', '#profession_type_id', function(e) {
            e.preventDefault();
            let profession_type_id = $(this).val();
            let option = '<option value="">Select Profession Category</option>';
            let profession_category = $("#profession_category_id");

            if (profession_type_id) {
                $.ajax({
                    type: "GET",
                    url: "{{ url('/profession-category-options-by-profession-type') }}/" +
                        profession_type_id,
                    beforeSend: function() {
                        console.log("Searcing...");
                        profession_category.html(option);
                    },
                    success: function(response) {
                        profession_category.html(response);
                    },
                    error: function(xhr, status, error) {
                        profession_category.html(option);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                    }
                });
            } else {
                profession_category.html(option);
            }
        })
    </script>
@endpush
