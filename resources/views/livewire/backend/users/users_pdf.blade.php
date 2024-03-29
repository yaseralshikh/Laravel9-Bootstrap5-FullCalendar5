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
		</style>
	</head>

	<body>
		<h1>A simple, clean, and responsive HTML invoice template</h1>
		<h3>Because sometimes, all you need is something simple.</h3>
        <img src="{{ asset('backend/img/logo.png') }}" width="80px" alt="">
		<div>
            <table class="">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Mile</th>
                        <th>Specialization</th>
                        <th>Role</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->specialization->name }}</td>
                            <td>{{ $user->roles[0]->name }}</td>
                            <td>{{ $user->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="counter" colspan="8">Users : {{ $users->count() }}</th>
                    </tr>
                </tfoot>
            </table>
            <p style="text-align: justify">
                هذا النص هو مثال لنص يمكن أن يستبدل في نفس المساحة، لقد تم توليد هذا النص من مولد النص العربى، حيث يمكنك أن تولد مثل هذا النص أو العديد من النصوص الأخرى إضافة إلى زيادة عدد الحروف التى يولدها التطبيق.
                إذا كنت تحتاج إلى عدد أكبر من الفقرات يتيح لك مولد النص العربى زيادة عدد الفقرات كما تريد، النص لن يبدو مقسما ولا يحوي أخطاء لغوية، مولد النص العربى مفيد لمصممي المواقع على وجه الخصوص، حيث يحتاج العميل فى كثير من الأحيان أن يطلع على صورة حقيقية لتصميم الموقع.
                ومن هنا وجب على المصمم أن يضع نصوصا مؤقتة على التصميم ليظهر للعميل الشكل كاملاً،دور مولد النص العربى أن يوفر على المصمم عناء البحث عن نص بديل لا علاقة له بالموضوع الذى يتحدث عنه التصميم فيظهر بشكل لا يليق.
                هذا النص يمكن أن يتم تركيبه على أي تصميم دون مشكلة فلن يبدو وكأنه نص منسوخ، غير منظم، غير منسق، أو حتى غير مفهوم. لأنه مازال نصاً بديلاً ومؤقتاً.
            </p>
		</div>
	</body>
</html>
