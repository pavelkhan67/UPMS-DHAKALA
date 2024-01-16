@extends('backend.master', ['mainMenu' => 'Organization', 'subMenu' =>'TradeLicense'])
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
    </style>
@endpush
@section('title', 'Oranization Trade License')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Oranization Trade License</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('organizationA.trade-license.index')}}">Organization Trade License</a></li>
                        <li class="breadcrumb-item active">License</li>
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
                      
                        <!-- /.card-header -->
                        <!-- form start -->

                        <div class="card-body">

                          <div class="row  text-center">
                              <div class="col-md-12 ">
                                  <img height="70" width="70" class="mx-auto d-block" src="{{ isset($license->organization->institute->top_image) ? asset($license->organization->institute->top_image)  : asset('public/backend/img/certificate/govt-bd-logo.png') }}" alt="govt-bd-logo">
                              </div>
                          </div>

                            <div class="row mt-2">
                                <div class="col-md-2 text-right">
                                    <img height="70" width="70" class="mx-auto d-block" src=" {{ isset($license->organization->institute->left_image) ? asset($license->organization->institute->left_image) : 'https://seeklogo.com/images/M/moharajpur-union-logo-6FAC2CBD46-seeklogo.com.png ' }}" alt="govt-bd-logo">
                                </div>
                                <div class="col-md-8 text-center">
                                    <h2 class="text-danger bold">
                                        {{ $license->organization->institute->union->bn_name ?? '' }}
                                    </h2>
                                    <p>
                                        ডাকঘরঃ <strong class="text-success">
                                                    {{ $license->organization->institute->union->bn_name ?? '' }}
                                                </strong>,
                                        থানাঃ <strong class="text-success">
                                                {{ $license->organization->institute->union->thana->bn_name ?? '' }}
                                             </strong>,
                                        জেলাঃ <strong class="text-success">
                                                {{ $license->organization->institute->union->thana->district->bn_name ?? '' }}, বাংলাদেশ 
                                              </strong>
                                    </p>
                                </div>
                                <div class="col-md-2 text-left">
                                    <img height="70" width="70" class="mx-auto d-block" src="{{ isset($license->organization->institute->right_image) ? asset($license->organization->institute->right_image) : 'https://upload.wikimedia.org/wikipedia/en/thumb/a/ab/Mujib_100_Logo.svg/1200px-Mujib_100_Logo.svg.png' }} "
                                        alt="govt-bd-logo">
                                </div>
                            </div>


                            <div class="row character-tax mt-2">
                                <div class="col-md-4 text-left">
                                    <h6 class=" mt-2">নম্বর- 
                                        <strong class="text-success">{{ bnValue($license->system_id ?? '--') }}</strong>
                                    </h6>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h3 class="text-light bg-success bold p-2">TRADE LICENSE INVOICE</h3>
                                    <h6 class="bold p-2">অর্থ বছর: 
                                        <strong>{{$license->taxYear->bn_name}}</strong>
                                    </h6>
                                </div>
                                <div class="col-md-4 text-right">
                                    <h6 class="mt-2">তারিখঃ
                                        {{ bnValue(date('d/m/Y', strtotime($license->updated_at))) }} খ্রিঃ
                                    </h6>
                                </div>
                            </div>


                            <div>

                                <table class=" table my-2 user_info_table">
                                    <tr>
                                        <td class="bg-dark text-light"> 
                                            প্রতিষ্ঠানের তথ্য: 
                                        </td>
                                        <td> 
                                            <strong> 
                                                আইডি নং-{{ bnValue($license->organization->system_id ?? '') }}, 
                                                নাম: {{ $license->organization->name ?? '' }}   
                                            </strong> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="bg-dark text-light"> প্রতিষ্ঠান সংক্রান্ত তথ্য: </td>
                                        <td> 
                                            <strong> 
                                                বাড়ি নং-{{ $license->organization->house->house_bn ?? '' }}, 
                                                এলাকা: {{ $license->organization->villageArea->bn_name ?? '' }}, 
                                                গ্রাম: {{ $license->organization->village->bn_name ?? '' }} 
                                            </strong> 
                                        </td>
                                  </tr>
                                </table>

                                <table class="table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" style="width: 10%">SL No.</th>
                                            <th rowspan="2">Fees Head</th>
                                            <th>Fees</th>
                                        </tr>
                                    </thead>

                                    
                                    <tbody id="load-fees">
                                        @php
                                            $total_fee = 0;
                                            $index = 0;
                                            $fees = json_decode($license->fees, true);
                                        @endphp
                                        @if (!empty( $fees))
                                            
                                        @foreach ($fees as $key => $fee)
                                            @php
                                                $total_fee = $total_fee + $fee;
                                            @endphp
                                            <tr>
                                                <td>{{++$index}}</td>
                                                <td class="text-left">{{$key}}</td>
                                                <td class="text-right">{{currencyFormat($fee)}}</td>
                                            </tr> 
                                        @endforeach

                                        @endif

                                        
                                        <tr>
                                            <td>Total: </td>
                                            <td class="text-right" colspan="2">{{currencyFormat($total_fee)}}</td>
                                        </tr> 
                                    </tbody>

                                </table>

                               
                            </div>

                            <div>
                              <table class="table border table-borderless text-center">
                                <tr>
                                  <td>
                                    <br><br>
                                    <p>------------------------------</p>
                                    <p>লাইসেন্স ও বিজ্ঞাপন সুপার ভাইজার</p>
                                  </td>
                                  <td>
                                    <br><br>
                                    <p>------------------------------</p>
                                    <p>সীল</p>
                                  </td>
                                  <td>
                                    <br><br>
                                    <p>------------------------------</p>
                                    <p>কর্তৃপক্ষ</p>
                                  </td>
                                </tr>
                              </table>
                            </div>
                            <div class="row">
                              <div class="col-md-12 text-right">
                                  <small>Develop & Maintenance by:<a href="https://www.jatri24.com"> Jatri 24 Ltd.</a> & <a href="https://www.adventure-soft.com"> Adventure Soft Ltd.</a></small>
                              </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-sm-9">
                                    <button type="button" id="printPageButton" class="btn btn-secondary text-right"
                                        onClick="window.print();">Print</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-footer -->
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
@endpush
