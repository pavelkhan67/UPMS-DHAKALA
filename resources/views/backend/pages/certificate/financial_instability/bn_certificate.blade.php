<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Financial Instability Certificate</title>

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

                                            <h2 class="text-light bg-success bold">আর্থিক অস্বচ্ছলতার সনদ</h2>
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
                                            <p>আমার জানা মতে সে আর্থিকভাবে অস্বচ্ছল।</p>
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
