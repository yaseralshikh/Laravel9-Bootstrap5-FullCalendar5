<!DOCTYPE html>
<html lang="ar">
	<head>
		<meta charset="utf-8" />
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title>responsive HTML Tasks List</title>
		<!-- Invoice styling -->
		<style>
            *{
                direction: rtl;
                padding: 0%;
                margin: 0%;
            }
			body {
				font-family: 'amiri', sans-serif;
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
                text-align: center;
            }
            th{
                background-color: rgb(225, 222, 222);
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            img{
                margin-bottom: 5px;
            }
		</style>
	</head>

	<body>
        {{-- <img src="{{ asset('backend/img/sweeklyplan_logo.jpg') }}" width="180px;" alt=""> --}}
		<h3>كشف بالمدارس التي لم تزار خلال {{ $semester->title }} - {{ $tasks[0]->office->name }}</h3>
        <p>{{ date('Y-m-d') }}</p>
		<div>
            <table class="">
                <thead class="">
                    <tr>
                        <th>#</th>
                        <th>اسم المدرسة</th>
                        <th>المرحلة</th>
                        <th>عدد الزيارات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $index => $task)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $task->name }}</td>
                            <td>{{ $task->level->name }}</td>
                            <td>{{ $task->events_count }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
		</div>
	</body>
</html>
