@extends('backend.master', ['mainMenu' => 'People', 'subMenu' =>'View'])
@push('style')
<style>
    @media print {
        #printPageButton {
            display: none;
        }

        .bg-success {
            background: #28a745 !important;
            color: #fff;
        }

        footer {
            display: none;
        }

        .content-wrapper,
        .container,
        .card,
        .card-footer {
            background: #ffffff
        }

        .border-dark {
            border: 1px solid #343a40 !important;
        }
    }

    .text-blue {
        color: #0000ff;
    }

    .content p {
        font-size: 15px;
        font-weight: 600;
        margin-bottom: 0px;
    }

    .data {
        font-size: 15px;
        padding-left: 10px;
        color: #28a745;
    }

    .dataa {
        font-size: 15px;
        color: #28a745;
    }

    .dataprofession {
        font-size: 16px;
        font-weight: 600;
    }

    .data1 {
        font-size: 15px;
        padding-left: 12px;
        margin-bottom: 10px;
        color: #28a745;
        padding-right: 16px;
    }

    .data2 p {
        margin-bottom: 10px;
    }

    .other {
        td {
            padding: 4.9px;
        }

        td p {
            margin: 0;
            font-size: 15px;
        }
    }

    .fw-bold1 {
        font-weight: 600;
    }

    .datatdpadding {
        td {
            padding: 7px;
        }
    }
</style>
@endpush
@section('title', 'People View')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-sm-4">
                <h1>People Information</h1>
            </div>
            <div class="col-sm-4 text-center">
                <button id="printPageButton" class="btn btn-outline-primary btn-sm text-center" onClick="window.print();"> <i class="fa fa-print"></i> Print</button>
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('people.index')}}">People</a></li>
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
                        <h1>People Information</h1>
                    </div>
                    <div class="card-body">

                        <div class="d-flex align-items-center ">
                            <div class="">
                                <img class="rounded-circle " src="{{asset('public/backend/img/certificate/govt-bd-logo.png')}}" alt="" style="height: 100px; width:100px">
                            </div>
                            <!-- make these data dynamic -->
                            <div class="" style="padding-left: 10px;">
                                <h1 class="text-danger bold">বাহাদুরপুর ইউনিয়ন পরিষদ </h1>
                                <p style="font-weight: 500;">
                                    ডাকঘরঃ <strong class="text-success">বাহাদুরপুর</strong>,
                                    থানাঃ <strong class="text-success">ভেড়ামারা</strong>,
                                    জেলাঃ <strong class="text-success"> কুষ্টিয়া, বাংলাদেশ</strong>
                                </p>
                            </div>
                        </div>

                        <div style="margin-left: 0px;">
                            <div class="mt-4 mb-2 d-flex border" style="height: 210px; width:100%;">
                                <div class=" div1 border m-1 " style="width: 20%; height: full;">
                                    <img class="img-fluid" src="{{ $user->image ? asset($user->image) : asset('public/no-image-found.jpeg') }}" style="height: 100%;" alt="Preview">
                                </div>

                                <div class="mt-1 mb-1 ms-1 data2 border pt-1" style="padding-left: 12px; padding-right: 16px; width: 20%; height: full;">
                                    <p>Name: </p>
                                    <p>Name Bangla: </p>
                                    <p>Email:</p>
                                    <p>Mobile No:</p>
                                    <p>Date of Birth:</p>
                                    <p>District:</p>
                                </div>
                                <div class="pt-1 mb-1 mt-1 me-1" style="border-width: 1px; border-color: #dee2e6; border-style: solid; border-left: none; width: 27%; height: full;">
                                    <div class="data1">{{ $user->name ?? 'N/A' }}</div>
                                    <div class="data1">{{ $user->people->bn_name ?? 'N/A' }} </div>
                                    <div class="data1">{{ $user->email ?? 'N/A' }}</div>
                                    <div class="data1">{{ $user->mobile ?? 'N/A' }}</div>
                                    <div class="data1">{{ $user->people->date_of_birth ?? 'N/A' }}</div>
                                    <div class="data1">
                                        @if (count($districts))
                                        @foreach ($districts as $district)
                                        @if (isset($user->people->district_id) && $user->people->district_id == $district->id)
                                        {{ $district->name }}
                                        @endif
                                        @endforeach
                                        @else
                                        N/A
                                        @endif
                                    </div>
                                </div>

                                <div class="div3 m-1 other" style="width: 32%; height: full;">
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr class="text-center text-success fw-bold1 ">
                                                <td colspan="2">Other Information</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Gender:</p>
                                                </td>
                                                <td>
                                                    <div class="data" id="gender">
                                                        @if (count(people_constant_option('gender')))
                                                        @foreach (people_constant_option('gender') as $key => $item)
                                                        @if (isset($user->people->gender) && $user->people->gender == $key)
                                                        {{ $item }}
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Religion:</p>
                                                </td>
                                                <td>
                                                    <div class="data" id="religion_name">
                                                        @if (count($religions))
                                                        @foreach ($religions as $religion)
                                                        @if (isset($user->people->religion_id) && $user->people->religion_id == $religion->id)
                                                        {{ $religion->name }}
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Blood Group: </p>
                                                </td>
                                                <td>
                                                    <div class="data" id="blood_group">
                                                        @if (count(people_constant_option('blood_group')))
                                                        @foreach (people_constant_option('blood_group') as $key => $item)
                                                        @if (isset($user->people->blood_group) && $user->people->blood_group == $key)
                                                        {{ $item }}
                                                        @endif
                                                        @endforeach
                                                        @else
                                                        N/A
                                                        @endif
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>Birth Reg. No:</p>
                                                </td>
                                                <td>
                                                    <div class="data">{{ $user->birth_certificate ?? 'N/A' }}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>NID No: </p>
                                                </td>
                                                <td>
                                                    <div class="data">{{ $user->nid ?? 'N/A' }}</div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <!-- Family Information -->
                            <div class="text-center mt-4 mb-2">
                                <h6 class="text-blue" style="font-size: 24px;">Family Information </h6>
                            </div>

                            <div class="">
                                <table class="datatdpadding table table-bordered">
                                    <tbody>

                                        <tr>
                                            <td>
                                                <p>Father's Name:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->father_name ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <p>Father's ID:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->father_nid ?? 'N/A'}}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>Mother's Name:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->mother_name ??'N/A'}}</div>
                                            </td>
                                            <td>
                                                <p>Mother's ID:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->mother_nid ?? 'N/A'}}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>Marital Status:</p>
                                            </td>
                                            <td>
                                                <div class="data" id="marital_status">
                                                    @if ($user->familyInfo)
                                                    @foreach (family_constant_option('marital_status') as $key => $marital_status)
                                                    @if ($user->familyInfo->marital_status == $key)
                                                    {{ $marital_status }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <p>Spouse Name:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->spouse_name ?? 'N/A'}}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>Spouse's ID:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->spouse_nid ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <p>Married Date:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->married_date ?? 'N/A'}}</div>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <p>Number of Boys:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->boys ?? 'N/A'}}</div>
                                            </td>
                                            <td>
                                                <p>Number of Girls:</p>
                                            </td>
                                            <td>
                                                <div class="data">{{$user->familyInfo->girls ?? 'N/A'}}</div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>

                            <!-- Contact Information -->
                            <div class="text-center mt-4 mb-2">
                                <h6 class="text-blue" style="font-size: 24px;">Contact Information </h6>
                            </div>

                            <div class="">
                                <table class="datatdpadding table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="text-success fw-bold1 pt-3" style="width:19%;">Permanent Address</td>
                                            <td>House-<span class="dataa" id="permanent_house">
                                                    @if ($user->addressInfo && count($permanent_houses))
                                                    @foreach ($permanent_houses as $house)
                                                    @if (isset($user->addressInfo->permanentHouse->id) && $user->addressInfo->permanentHouse->id == $house->id)
                                                    {{ $house->house }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>, Road-<span class="dataa" id="permanent_road">
                                                    @if ($user->addressInfo && count($roads))
                                                    @foreach ($roads as $road)
                                                    @if (isset($user->addressInfo->permanentRoad->id) && $user->addressInfo->permanentRoad->id == $road->id)
                                                    {{ $road->name }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>, Ward- <span class="dataa" id="permanent_ward">
                                                    @if ($user->addressInfo && count($wards))
                                                    @foreach ($wards as $ward)
                                                    @if ($user->addressInfo->permanent_ward_id == $ward->id)
                                                    {{ $ward->en_ward_no }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>, Village- <span class="dataa" id="permanent_village">
                                                    @if ($user->addressInfo && count($villages))
                                                    @foreach ($villages as $village)
                                                    @if ($user->addressInfo->permanent_village_id == $village->id)
                                                    {{ $village->en_name }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>
                                            </td>
                                            <!-- </tr>
                                    <tr> -->

                                            <td class="text-success fw-bold1 pt-3" style="width:17%;">Present Address</td>
                                            <td>House- <span class="dataa" id="present_house">
                                                    {{ $user->addressInfo->presentHouse->house ?? 'N/A' }}
                                                </span>, Road- <span class="dataa" id="present_road">
                                                    {{ $user->addressInfo->presentRoad->road ?? 'N/A' }}
                                                </span>, Area- <span class="dataa">{{$user->addressInfo->present_area ?? 'N/A'}}</span>, <span class="dataa" id="present_thana">
                                                    {{ $user->addressInfo->presentThana->name ?? 'N/A' }}
                                                </span>, <span class="dataa" id="present_district">
                                                    {{ $user->addressInfo->presentDistrict->name ?? 'N/A' }}
                                                </span>, <span class="dataa" id="present_division">
                                                    @if ($user->addressInfo && count($divisions))
                                                    @foreach ($divisions as $division)
                                                    @if ($user->addressInfo->present_division_id == $division->id)
                                                    {{ $division->name }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Education Information  -->
                            @if (count($user->educationInfos))
                            <div class="text-center mt-4 mb-2">
                                <h6 class="text-blue" style="font-size: 24px;">Education Information </h6>
                            </div>

                            <div class="">
                                <div class="row">
                                    @foreach ($user->educationInfos as $education)
                                    <div class="col-{{ 12 / count($user->educationInfos) }}">
                                        <table class="datatdpadding table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <p>Degree:</p>
                                                    </td>
                                                    <td>
                                                        <div class="data" id="degree">
                                                            @php
                                                            $degreeOptions = [
                                                            1 => 'HSC',
                                                            2 => 'SSC',
                                                            3 => 'JSC',
                                                            ];
                                                            $selectedDegree = $degreeOptions[$education->degree_id] ?? '';
                                                            @endphp

                                                            {{ $selectedDegree }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Group:</p>
                                                    </td>
                                                    <td>
                                                        <div class="data" id="group">
                                                            @php
                                                            $groupOptions = [
                                                            1 => 'Science',
                                                            2 => 'Business',
                                                            3 => 'Humanities',
                                                            ];
                                                            $selectedGroup = $groupOptions[$education->group_id] ?? '';
                                                            @endphp

                                                            {{ $selectedGroup }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Grade:</p>
                                                    </td>
                                                    <td>
                                                        <div class="data" id="grade">
                                                            @php
                                                            $gradeOptions = [
                                                            1 => 'A+',
                                                            2 => 'A',
                                                            3 => 'A-',
                                                            4 => 'B+',
                                                            5 => 'B',
                                                            6 => 'B-',
                                                            7 => 'C+',
                                                            8 => 'C',
                                                            9 => 'D',
                                                            10 => 'F',
                                                            ];
                                                            $selectedGrade = $gradeOptions[$education->grade_id] ?? '';
                                                            @endphp

                                                            {{ $selectedGrade }}
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Institute:</p>
                                                    </td>
                                                    <td>
                                                        <div class="data">{{$education->institute}}</div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <p>Board:</p>
                                                    </td>
                                                    <td>
                                                        <div class="data" id="board">
                                                            @php
                                                            $boardOptions = [
                                                            1 => 'Dhaka',
                                                            2 => 'Rajshahi',
                                                            3 => 'Rangpur',
                                                            4 => 'Jessore',
                                                            5 => 'Comilla',
                                                            6 => 'Sylhet',
                                                            7 => 'Chittagong',
                                                            ];
                                                            $selectedBoard = $boardOptions[$education->board_id] ?? '';
                                                            @endphp

                                                            {{ $selectedBoard }}
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @else
                            N/A
                            @endif

                            <!-- Profession Information -->

                            @if (count($user->professionalInfos))
                            <div class="text-center my-2">
                                <h6 class="text-blue" style="font-size: 24px;">Profession Information </h6>
                            </div>
                            @foreach ($user->professionalInfos as $professionalInfo)
                            <div class="">
                                <table class="datatdpadding table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="dataprofession" style="padding: 12px;">
                                                <span id="profession_type">
                                                    {{ $professionalInfo->subcategory->category->type->en_name ?? '' }}
                                                </span> <span id="profession">
                                                    @if (isset($professionalInfo->subcategory->category->type->profession_id))
                                                    @foreach ($professions as $profession)
                                                    @if ($professionalInfo->subcategory->category->type->profession_id == $profession->id)
                                                    {{ $profession->en_name }}
                                                    @endif
                                                    @endforeach
                                                    @else
                                                    N/A
                                                    @endif
                                                </span>, <span id="profession_category">
                                                    {{ $professionalInfo->subcategory->category->en_name ?? 'N/A' }}
                                                </span> (<span id="profession_subcategory">
                                                    {{ $professionalInfo->subcategory->en_name ?? 'N/A' }}
                                                </span>)
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endforeach
                            @else
                            N/A
                            @endif

                            <!-- Disability Information -->

                            <div class="text-center mt-4 mb-2">
                                <h6 class="text-blue" style="font-size: 24px;">Disability </h6>
                            </div>

                            <div class="">
                                <table class="datatdpadding table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="dataprofession " style="padding: 12px;">
                                                <span id="selected_disability_name">
                                                    @php
                                                    $selectedDisabilityName = null;
                                                    foreach (disability_constant_option('disability_name') as $key => $item) {
                                                    if (isset($user->disabilityInfo->disability_name_id) && $user->disabilityInfo->disability_name_id == $key) {
                                                    $selectedDisabilityName = $item;
                                                    break;
                                                    }
                                                    }
                                                    @endphp

                                                    {{ $selectedDisabilityName ?? 'N/A' }}
                                                </span> <span id="selected_disability_type">-
                                                    @php
                                                    $selectedDisabilityType = null;
                                                    foreach (disability_constant_option('disability_type') as $key => $item) {
                                                    if (isset($user->disabilityInfo->disability_type_id) && $user->disabilityInfo->disability_type_id == $key) {
                                                    $selectedDisabilityType = $item;
                                                    break;
                                                    }
                                                    }
                                                    @endphp

                                                    {{ $selectedDisabilityType ?? 'N/A' }}
                                                </span>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Freedom Fighter Information -->

                            <div class="text-center mt-4 mb-2">
                                <h6 class="text-blue" style="font-size: 24px;">Freedom Fighter </h6>
                            </div>

                            <div class="">
                                <table class="datatdpadding table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td class="dataprofession " style="padding: 12px;">
                                                <span id="selected_type">
                                                    @php
                                                    $selectedType = null;
                                                    foreach (freedom_fighter_constant_option('type') as $key => $item) {
                                                    if (isset($user->freedomFighterInfo->type_id) && $user->freedomFighterInfo->type_id == $key) {
                                                    $selectedType = $item;
                                                    break;
                                                    }
                                                    }
                                                    @endphp

                                                    {{ $selectedType ?? 'N/A' }}
                                                </span> <span id="selected_designation">-
                                                    @php
                                                    $selectedDesignation = null;
                                                    foreach (freedom_fighter_constant_option('designation') as $key => $item) {
                                                    if (isset($user->freedomFighterInfo->designation_id) && $user->freedomFighterInfo->designation_id == $key) {
                                                    $selectedDesignation = $item;
                                                    break;
                                                    }
                                                    }
                                                    @endphp

                                                    {{ $selectedDesignation ?? 'N/A' }}
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>

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
@endpush