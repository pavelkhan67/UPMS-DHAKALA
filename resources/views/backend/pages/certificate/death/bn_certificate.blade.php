<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Death Certificate</title>

    <style>
        body {
            padding: 0;
            margin: 0;
        }

        .first-border {
            border: 1px solid black;
            padding: 14px;
        }

        .second-border {
            border: 1px solid #17a2b8;
            padding: 14px;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-danger {
            color: #dc3545;
        }

        .bg-success {
            background-color: #28a745;
        }

        .bg-blue {
            background-color: #28a745;
        }

        .text-green {
            color: #28a745;
        }

        .text-blue {
            color: #1a73e8
        }

        .text-light {
            color: #fff;
        }

        .text-info {
            color: #17a2b8 !important;
        }


        .wrapper {
            background-color: #ffffff;
        }


        .ml-2 {
            padding-left: 2rem;
        }

        .mr-2 {
            padding-right: 2rem;
        }

        .text-justify {
            text-align: justify;
        }

        .line-height {
            line-height: 1.7;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="first-border">
                <div class="second-border">
                    <div class="card">
                        <div class="card-body">
                            <table>

                                <thead>
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <img height="90" width="90" class="mx-auto d-block" style="padding-right:25px;" src="{{ asset($certificate->user->institute->top_image) }}" alt="top_image">
                                        </td>
                                    </tr>

                                    <tr class="col-4">
                                        <td class="text-right" style="vertical-align: top; padding-right: 24px;">
                                            <img height="85" width="90" class="mx-auto d-block" src="{{ asset($certificate->user->institute->left_image) }}" alt="left_image">
                                            <h4 class="text-green mt-4">নম্বর-{{ bnValue($certificate->system_id ?? '') }}</h4>
                                        </td>

                                        <td class="text-center" style="vertical-align: top;">
                                            <h1 style="margin-top: 0;">
                                                <strong class="text-danger bold">
                                                    {{ $certificate->user->institute->union->bn_name ?? '' }} ইউনিয়ন পরিষদ
                                                </strong>
                                                <br>
                                                <span style="font-size: 14px">
                                                    ডাকঘরঃ <strong class="text-green">{{ $certificate->user->institute->union->bn_name ?? '' }}</strong>,
                                                    থানাঃ <strong class="text-green">{{ $certificate->user->institute->union->thana->bn_name ?? '' }}</strong>,
                                                    জেলাঃ <strong class="text-green">{{ $certificate->user->institute->union->thana->district->bn_name ?? '' }}, বাংলাদেশ</strong>
                                                </span>
                                            </h1>

                                            <h2 class="text-light bg-success bold">Death Certificate</h2>
                                        </td>

                                        <td class="text-left" style="vertical-align: top; padding-left: 24px;">
                                            <img height="85" width="90" class="mx-auto d-block" src="{{ asset($certificate->user->institute->right_image) }}" alt="right_image">
                                            <h4 class="mt-4">তারিখঃ {{ bnValue(date('d/m/Y', strtotime($certificate->created_at))) }} খ্রিঃ</h4>
                                        </td>
                                    </tr>

                                </thead>


                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <p class="text-justify line-height">
                                                এই মর্মে প্রত্যয়ন করা যাচ্ছে যে, {{isset($certificate->user->people->gender) ? ($certificate->user->people->gender == 1 ? 'জনাব' : 'জনাবা') : '' }} <strong class="text-green">{{ $certificate->user->people->bn_name ?? '' }}</strong>,
                                                আইডি নং <strong class="text-green"> {{ bnValue($certificate->user->system_id ?? '') }}</strong>
                                                পিতাঃ <strong class="text-info">{{isset($certificate->user->people->father_live_status) ? ($certificate->user->people->father_live_status == 2 ? 'মৃত' : "") : ''}} {{ $certificate->user->familyInfo->father_name_bn ?? '' }}</strong>
                                                এবং মাতাঃ <strong class="text-info">{{isset($certificate->user->people->mother_live_status) ? ($certificate->user->people->mother_live_status ==2 ? 'মৃত' : "") : ''}} {{ $certificate->user->familyInfo->mother_name_bn ?? '' }}</strong>,

                                                স্থায়ী ঠিকানাঃ
                                                গ্রাম - <strong class="text-info">{{$certificate->user->addressInfo->permanentVillage->bn_name ?? '' }}</strong>,
                                                ওয়ার্ড- <strong class="text-info">{{ $certificate->user->addressInfo->permanentWard->bn_ward_no ?? '' }}</strong>,
                                                এলাকা- <strong class="text-info">{{ $certificate->user->addressInfo->permanentArea->bn_name ?? '' }}</strong>,
                                                রাস্তা- <strong class="text-info">{{ $certificate->user->addressInfo->permanentRoad->bn_name ?? '' }}</strong>,
                                                বাড়ি- <strong class="text-info">{{ $certificate->user->addressInfo->permanentHouse->house_bn ?? '' }}</strong>,

                                                বর্তমান ঠিকানাঃ
                                                গ্রাম- <strong class="text-info">{{$certificate->user->addressInfo->presentVillage->bn_name ?? '' }}</strong>,
                                                ওয়ার্ড- <strong class="text-info">{{ $certificate->user->addressInfo->presentWard->bn_ward_no ?? '' }}</strong>,
                                                এলাকা- <strong class="text-info">{{ $certificate->user->addressInfo->presentArea->bn_name ?? '' }}</strong>,
                                                রাস্তা- <strong class="text-info">{{ $certificate->user->addressInfo->presentRoad->bn_name ?? '' }}</strong>,
                                                বাড়ি- <strong class="text-info">{{ $certificate->user->addressInfo->presentHouse->house_bn ?? '' }}</strong>,
                                                ফ্ল্যাট- <strong class="text-info">{{ bnValue($certificate->user->addressInfo->present_flat ?? '') }}</strong>
                                                অত্র ইউনিয়নের বাসিন্দা। জন্মসূত্রে তিনি বাংলাদেশের নাগরিক। ব্যক্তিগতভাবে আমি তাকে চিনি।

                                            </p>
                                            <p>আমার জানা মতে তিনি কোন অসামাজিক ও রাষ্ট্র বিরোধী কোন কাজে জড়িত নন। তার স্বভাব চরিত্র ভালো।</p>
                                            <p>আমি তার সার্বিক কল্যাণ ও মঙ্গলময় উন্নত জীবন কামনা করি।</p>

                                        </td>
                                    </tr>

                                </tbody>


                                <tfoot>
                                    <tr>
                                        <td colspan="3" class="text-right">
                                            <p>চেয়ারম্যান</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p>NB.: Any Query <a href="https://www.upbd.com" target="_blank">www.upbd.com</a></p>
                                        </td>
                                    </tr>
                                </tfoot>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="card-footer">
            <p>This report generated by Jatri 24 Ltd. <a href="https://www.jatri24.com">www.jatri24.com</a></p>
        </footer>
    </div>

</body>

</html>
@extends('backend.master', ['mainMenu' => 'Certificate', 'subMenu' =>'Childless'])
@push('style')

@endpush
@section('title', 'Childless Certificate')
@section('content')
<div class="container">
  <div class="card mt-2">
      <div class="card-body border border-dark ">
          <div class="border border-5 border-info p-5">
              <div class="row  text-center">
                  <div class="col-md-12 ">
                      <img height="100" width="100" class="mx-auto d-block"
                          src="{{ isset($certificate->user->institute->top_image) ? asset($certificate->user->institute->top_image)  : asset('public/backend/img/certificate/govt-bd-logo.png') }}" alt="govt-bd-logo">
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-2 text-right">
                      <img height="100" width="100" class="mx-auto d-block"
                          src=" {{isset($certificate->user->institute->left_image) ? asset($certificate->user->institute->left_image)  : 'https://seeklogo.com/images/M/moharajpur-union-logo-6FAC2CBD46-seeklogo.com.png '}}"
                          alt="govt-bd-logo">
                  </div>
                  <div class="col-md-8 text-center">
                      <h1 class="text-danger bold">{{ $certificate->user->institute->union->name ?? '' }} Union Parishad
                      </h1>
                      <p>
                          PS.:-   <strong class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                          Dist.:- <strong class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                                  <strong class="text-danger">Dhaka</strong>,Bangladesh
                      </p>
                  </div>
                  <div class="col-md-2 text-left">
                      <img height="100" width="100" class="mx-auto d-block"
                          src="{{isset($certificate->user->institute->right_image) ? asset($certificate->user->institute->right_image)  : 'https://upload.wikimedia.org/wikipedia/en/thumb/a/ab/Mujib_100_Logo.svg/1200px-Mujib_100_Logo.svg.png'}} "
                          alt="govt-bd-logo">
                  </div>
              </div>
              <div class="row character-certificate">
                  <div class="col-md-2">
                      <h6 class="text-success mt-4">No. : {{ $certificate->system_id ?? '' }}</h6>
                  </div>
                  <div class="col-md-8 text-center">
                      <h3 class="text-light bg-success bold">Ch i l d l e s s  Ce r t i f i c a t e</h3>
                  </div>
                  <div class="col-md-2">
                      <h6 class="text-success mt-4">Date : {{ date('d.m.Y', strtotime($certificate->created_at)) }}
                      </h6>
                  </div>
              </div>
              <div class="row mt-5">
                  <div class="col-md-12 certificate-body">
                      <p>This is to certify that <strong class="text-danger">{{ $certificate->user->name ?? '' }}</strong>
                          Id no.: <strong class="text-danger"> {{ $certificate->user->system_id ?? '' }}</strong>
                          son of <strong
                              class="text-danger">{{ family_live_status($certificate->user->familyInfo->father_live_status ?? 0) }}
                              {{ $certificate->user->familyInfo->father_name ?? '' }}</strong> & <strong
                              class="text-danger">{{ family_live_status($certificate->user->familyInfo->mother_live_status ?? 0) }}
                              {{ $certificate->user->familyInfo->mother_name ?? '' }}</strong>,
                          Village: <strong
                              class="text-danger">{{ $certificate->user->addressInfo->permanentVillage->en_name ?? '' }}</strong>,
                          <strong
                              class="text-danger">Road-{{ $certificate->user->addressInfo->permanent_road ?? '' }}</strong>,
                          <strong class="text-danger">House-03</strong>,
                          <strong class="text-danger">Ward
                              No.-{{ $certificate->user->addressInfo->presentWard->en_ward_no ?? '' }}</strong>, PO.:
                          <strong class="text-danger">{{ $certificate->user->institute->union->name ?? ''  }}</strong>, PS.
                          : <strong
                              class="text-danger">{{ $certificate->user->institute->union->thana->name ?? '' }}</strong>,
                          Dist.: <strong
                              class="text-danger">{{ $certificate->user->institute->union->thana->district->name ?? '' }}</strong>,
                          is known to me for about long time.
                          <br>
                          He is a citizen of Bangladesh by birth.
                      </p>
                      <br>
                      <p>To the best of my knowledge, he bears a good moral character and is not involved is such
                          activities which are against the country freedom and peace.</p>
                      <br>
                      <p>I wish all success and prosperity in his life.</p>
                      <br>
                      <p class="text-right">Chairman/Meyor</p>
                      <p>NB.: Any Query <a href="https://www.upbd.com" target="_blank">www.upbd.com</a></p>
                  </div>
              </div>
          </div>


      </div>
      <div class="card-footer">
          <p>This report generated by Jatri 24 Ltd. <a href="https://www.jatri24.com">www.jatri24.com</a></p>
          <button id="printPageButton" class="btn btn-outline-secondary btn-sm text-right"
              onClick="window.print();">Print</button>

      </div>
  </div>
</div>
@endsection
@push('script')
@endpush
