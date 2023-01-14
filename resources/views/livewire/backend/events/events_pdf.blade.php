<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        /* Style the body */
        body {
            font-family: 'amiri';
            display: table;
        }

        .container {
            margin: 15px;
            padding: 15px;
            width: 210mm;
            height: 297mm;
            /*border: solid green;*/
            text-align: center;
        }

        /* Header/logo Title */
        .header {
            margin-top: auto;
            margin-bottom: auto;
            margin-left: auto;
            margin-right: auto;
            /*border:solid red;*/
            /*background-color: green;*/
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .logo_header{
                border:none;
        }

        .content {
            padding: 35mm 15px 0 15px;
            height: 180mm;
            /*border:solid red;*/
            /* background-color: #fdfadb; */
        }

        h3{
            padding: 2;
            margin: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        td,
        th {
            border: 1px solid;
            text-align: center;
            font-size: large;
        }

        th {
            background-color: #ebebeb;
            padding: 5px;
        }

        .notes{
            padding: 15px;
            height: 25mm;
            /*border:solid red;*/
            /* background-color: rgb(130, 128, 246); */
        }

        /* Footer */
        footer {
            padding: 5px;
            height: 2mm;
            /*border:solid red;*/
            /* background-color: rgb(71, 156, 89); */
        }
        @page {
            margin-header: 5mm;
	        margin-footer: 5mm;
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($users as $user)
            <htmlpageheader name="page-header">
                <table class="logo_header" cellpadding="5" border="0" cellspacing="5">
                    <tbody class="logo_header">
                        <tr class="logo_header">
                            <td class="logo_header"><img src="{{ asset('backend/img/events/moe_logo_r.jpg') }}" width="150px" alt=""></td>
                            <td class="logo_header"><img src="{{ asset('backend/img/events/moe_logo.jpg') }}" width="150px" alt=""></td>
                            <td class="logo_header"><img src="{{ asset('backend/img/events/logo_L.jpg') }}" width="150px" alt=""></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            </htmlpageheader>

            <div class="content">
                <div class="">
                    <h3 style="font-size: 30px;">تكليف مشرف تربوي</h3>
                    <h3>المكرم المشرف التربوي : <span style="font-size: 22px;background-color:#f4f4f4;">&nbsp;{{ $user->name }}&nbsp;</span> &nbsp;&nbsp;&nbsp;وفقه الله</h3>
                    <h3>السلام عليكم ورحمة الله وبركاته</h3>
                    <h3>اعتمدوا القيام بالزيارات والمهام المحددة أدناه، سائلين الله لكم التوفيق</h3>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th colspan="4">تفاصيل الزيارة</th>
                        </tr>
                        <tr>
                            <th>#</th>
                            {{-- <th>الاسبوع</th> --}}
                            <th>أليوم</th>
                            <th>التاريخ</th>
                            <th>المهمة / المدرسة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->events as $index => $event)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                {{-- <td>{{ $event->week->title }}</td> --}}
                                <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->start) }}</td>
                                <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->start) }}</td>
                                <td>{{ $event->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    <ol style="text-align: justify;font-size: 14px;">
                        <span style="text-align: justify;font-size: 14px;font-weight: bold;">المهام :</span>
                        @foreach ($subtasks as $subtask)
                            <li>{{ $subtask->title }}</li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <div class="notes">
                <table class="logo_header" cellpadding="5" border="0" cellspacing="5">
                    <tbody>
                        <tr>
                            <td dir="rtl" class="logo_header" style="text-align:justify;font-size: 12px;line-height: 1.5;">
                                <ul style="list-style-type:none;">
                                    <li>ص : متابعة الدوام</li>
                                    <li>ص : الشؤون التعليمية / إدارة الاشراف.</li>
                                    <li>ص : مكتب سعادة مدير التعليم.</li>
                                </ul>
                                <br>
                                <ul>
                                    <li>سيتم اعتماد الخطط في نظام نور في تمام الساعة 7:45 من صباح كل يوم أحد من كل أسبوع.</li>
                                    <li>قد تكون هناك تعديلات على خطتك نظراً لتعارض زيارة أكثر من مشرف/يْن لمدرسة ، أو حسب توجيهات إدارة المكتب.</li>
                                    <li>عند رصد غياب معلم مسند أكثر من خمسة أيام دون عذر خلال العام، أو غياب وتأخر نسبة كبيرة أثناء الزيارة يجب إبلاغ إدارة المكتب وتدوينه بتقرير الزيارة المدرسية.</li>
                                </ul>
                            </td>
                            <td class="logo_header" style="width: 40%;">
                                <h3>مدير مكتب التعليم بوسط جازان</h3>
                                <br>
                                <h3>عبدالرحمن بن عسيري عكور</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <htmlpagefooter name="page-footer">
                <table>
                    <tbody>
                        <tr>
                            <td style="text-align:center;font-size: 12px;">ت : 0173215614</td>
                            <td style="text-align:center;font-size: 12px;">jazanoffice2015@gmail.com</td>
                            <td style="text-align:center;font-size: 12px;">رؤيتنا : تعليم ريادي</td>
                            <td style="text-align:center;font-size: 12px;">مكتب تعليم وسط جازان - بنين</td>
                        </tr>
                    </tbody>
                </table>
            </htmlpagefooter>
        @endforeach
    </div>
</body>
</html>
