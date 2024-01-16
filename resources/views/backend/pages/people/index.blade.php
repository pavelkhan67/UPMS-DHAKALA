@extends('backend.master', ['mainMenu' => 'People', 'subMenu' => 'View'])
@push('style')
    <style>
        #example1_wrapper .dataTables_filter {
            float: right;
        }

        #example1_wrapper .dataTables_paginate {
            float: right;
        }
    </style>
@endpush
@section('title', 'People View')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>People Information</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('people.index') }}">People</a></li>
                        <li class="breadcrumb-item active">View</li>
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
                            <h3 class="card-title">People List</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>ID & Name</th>
                                        <th>Mobile & Eamil</th>
                                        <th>Gender & DOB</th>
                                        <th>Institute</th>
                                        <th>Photo</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>


                                    @if ($users)

                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    @php
                                                    $system_id = '';
                                                    if(isset($user->system_id)) {
                                                        $system_id =  '<br>' . $user->system_id;
                                                    } 
                                                        
                                                    @endphp
                                                    {{ $user->name ?? '' }} 
                                                    {!! $system_id !!}
                                                </td>
                                                <td>
                                                    @php
                                                        $mobile = $user->mobile ? ('<a href="tel:'.$user->mobile.'">'.$user->mobile.'</a>') : '';
                                                        $email =  $user->email ? ('<br><a href="mailto:'.$user->email.'">'.$user->email.'</a>') : '';

                                                    @endphp

                                                    {!!$mobile!!}
                                                    {!!$email!!}
                                                  
                                                </td>
                                                <td>
                                                    @php
                                                        $gender = people_constant_option('gender');
                                                    @endphp
                                                    {{ $user->people->date_of_birth ?? '--' }}<br>
                                                    {{ isset($user->people->gender) ? ($gender[$user->people->gender])  : '--'  }}
                                                </td>
                                                <td>
                                                    @php
                                                      $instituteFind =  user_institute_information($user->institute_id);
                                                    @endphp
                                                    {{$instituteFind['institute']->name}} {{$instituteFind['institute_type']}}
                                                    
                                                </td>
                                                <td>
                                                    <img src="{{asset('/' ,$user->image )}}" alt="" srcset="">
                                                </td>
                                                <td style="width: 10%">
                                                   
                                                <div class="table-action">
                                                    @if (Auth::user()->institute_id && create_permission() )
                                                        <a href="{{ route('people.edit', $user->id) }}" title="Edit" data-toggle="tooltip" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a>
                                                        <a href="{{ route('people.show', $user->id) }}" title="Show" data-toggle="tooltip" class="btn btn-sm btn-info"><i class="fa fa-eye"></i></a>

                                                        <form class="deletePeople" method="post">
                                                          @csrf
                                                          @method('Delete')
                                                          <input type="hidden" class="deleteUrl" name="delete_url" value="">
                                                          <button type="submit" disabled class="btn btn-sm btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    @endif
                                                </div>

                                                </td>
                                            </tr>
                                        @endforeach

                                    @endif



                                </tbody>

                            </table>
                        </div>
                        <!-- /.card-body -->

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
            $("#peoplePersonalForm").on('submit', function(e) {
                e.preventDefault();
                let thisForm = $(this);
                $.ajax({
                    type: "POST",
                    url: "{{ route('people.store') }}",
                    data: new FormData(this),
                    dataType: "json",
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        thisForm.find('button[type="submit"]').prop("disabled", true);
                    },
                    success: function(response) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        toastr.success(response.message);
                        // setTimeout(function() {
                        //     location.href = "/";
                        // }, 2000)
                    },
                    error: function(xhr, status, error) {
                        thisForm.find('button[type="submit"]').prop("disabled", false);
                        var responseText = jQuery.parseJSON(xhr.responseText);
                        toastr.error(responseText.message);
                        $.each(responseText.errors, function(key, val) {
                            thisForm.find("." + key + "-error").text(val[0]);
                        });
                    }
                });
            })
        })
    </script>
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#image").change(function() {
            readURL(this);

        });
    </script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
