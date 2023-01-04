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
            height: 290mm;
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
            height: 190mm;
            /*background-color: #fdfadb;*/
            /*border:solid red;*/
            padding: 0 15px;
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
            background-color: #d4d4d4;
            padding: 5px;
        }

        /* Footer */
        footer {
            padding: 15px;
            height: 30mm;
            /*border:solid red;*/
            /* background-color: rgb(130, 128, 246); */
        }
    </style>
</head>

<body>
    <div class="container">
        @foreach ($users as $user)
            <div class="header">
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
            </div>

            <div class="content">
                <div class="">
                    <h3 style="font-size: 30px;">تكليف مشرف تربوي</h3>
                    <h3>المكرم المشرف التربوي : {{ $user->name }} &nbsp;&nbsp;&nbsp;&nbsp;وفقه الله</h3>
                    <h3>السلام عليكم ورحمة الله وبركاته</h3>
                    <h3>اعتمدوا القيام بالزيارات والمهام المحددة أدناه، سائلين الله لكم التوفيق</h3>
                </div>

                <table>
                    <thead style="background-color: #eaeaea">
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
                    <p style="text-align: justify;font-size: 14px;">
                        هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك
                        أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                        إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو
                        مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى
                        كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                        ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن
                        يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
                        هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى
                        غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.
                    </p>
                </div>
            </div>


            <footer>
                <table class="logo_header" cellpadding="5" border="0" cellspacing="5">
                    <tbody>
                        <tr>
                            <td class="logo_header" style="text-align: rtl;font-size: 12px;">
                                <ul>
                                    <li>صورة للمساعد للشؤون التعليمية</li>
                                    <li>صورة للمساعد للشؤون المدرسية</li>
                                    <li>صورة متابعة الدوام</li>
                                </ul>
                            </td>
                            <td class="logo_header">
                                <h3 style="width: 65%;">مدير مكتب التعليم بوسط جازان</h3>
                                <br>
                                <h3>عبدالرحمن بن عسيري عكور</p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </footer>
        @endforeach
    </div>
</body>
</html>
