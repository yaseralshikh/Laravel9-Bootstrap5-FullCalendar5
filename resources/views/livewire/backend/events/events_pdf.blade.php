<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>responsive HTML Users List</title>
		<!-- Invoice styling -->
		<style>
            *{
                direction: rtl;
            }
			body {
				font-family: 'KFGQPC', sans-serif;
				text-align: center;
                display: table;
                direction: rtl;
			}
            table, td, th {
                border: 1px solid;
                text-align: center;
            }
            .logo_header{
                border:0;
            }
            thead, tr ,th{
                padding: 10px;
            }
            .counter{
                padding: 10px;
                text-align: left;
            }
            th{
                background-color: rgb(225, 222, 222);
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            img{
                margin-bottom: 15px;
            }
            ul {
                width: 100%;
                display: table;
                table-layout: fixed;
                border-collapse: collapse;
            }
            li {
                display: table-cell;
                text-align: center;
                border: 1px solid hotpink;
                vertical-align: middle;
                word-wrap: break-word;
            }
		</style>
	</head>

	<body>
        <div style="width: 21cm !important;height: 29.7cm!important;">
            @foreach ($users as $user)
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

                <h1>تكليف مشرف تربوي</h1>
                <h3>المكرم المشرف التربوي : {{ $user->name }} وفقه الله</h3>
                <h3>السلام عليكم ورحمة الله وبركاته</h3>
                <h3>اعتمدوا القيام بالزيارات والمهام المحددة أدناه، سائلين الله لكم التوفيق</h3>
                <h2>تفاصيل الزيارة</h2>

                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسبوع</th>
                            <th>أليوم</th>
                            <th>التاريخ</th>
                            <th>المهمة / المدرسة</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user->events as $index => $event)
                            <tr>
                                <td>{{ $index +1 }}</td>
                                <td>{{ $event->week->title }}</td>
                                <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('l', $event->start) }}</td>
                                <td>{{ Alkoumi\LaravelHijriDate\Hijri::Date('Y-m-d', $event->start) }}</td>
                                <td>{{ $event->title }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <p style="text-align: justify">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                    إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                    ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
                    هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.
                </p>
                <p style="text-align: justify">
                    هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                    إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                    ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
                    هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.
                </p>
            @endforeach
        </div>
	</body>
</html>
