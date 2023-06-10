<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Myplan - خطتي (v2)</title>
    <link rel="icon" href="{{ asset('backend/img/sweeklyplan_logo.jpg') }}" type="image/icon type">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    {{-- AOS library --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css">

    <style>
        body {
            font-family: 'amiri';
            font-weight: bold;
        }
        .textJustify{
            text-align: justify;
            text-justify: inter-word;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">خطتي</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">عن النظام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#features">المميزات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact">التواصل</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <header class="bg-primary text-white text-center py-5">
        <h1 class="display-4">مبادرة منصة خطتي</h1>
        <p class="lead" dir="rtl">الإصدار الثاني من المبادرة التقنية التي تحمل إسم ( خطتي ) لادارة وتنظيم خطط المشرف التربوي خلال العام الدراسي.</p>
        <p>برعاية الإدارة العامة للتعليم بمنطقة جازان</p>
        <a href="https://myplan.sweeklyplan.com/login" class="btn btn-dark btn-lg mt-3">رابط الدخول للخدمة</a>
    </header>

    <section id="about" class="py-5" dir="rtl" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <h2 style="color:#014bae">مبادرة خطتي :</h2>
                    <p class="textJustify">انطلاقاً من هدف ضمان جودة بيئة العمل والأنظمة التقنية نقدم مبادرة تقنية تحت اسم ( خطتي ) وهي عبارة عن موقع الكتروني لإدارة وتنظيم العمليات المتعلقة بخطط المشرفين خلال الاعوام الدراسية وتخزينها وتحليلها بطريقة مبتكرة مما يسهل على المشرفين بمختلف إدارات ومكاتب التعليم من اعداد الخطط واعتمادها وفق أعلى مستوى من الجودة والأمان متماشياً مع رؤية المملكة العربية السعودية 2030 .</p>
                    <h4 style="color:#014bae">الأهداف :</h4>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item textJustify">-	بناء قاعدة بيانات لحفظ خطط المشرفين خلال العام الدراسي .</li>
                        <li class="list-group-item textJustify">-	اصدار تكاليف المشرفين التربويين حسب مرجعهم الإداري (شؤون تعليمية ، شؤون مدرسية ، خدمات مساندة) واختلاف المهام المطلوبة منهم.</li>
                        <li class="list-group-item textJustify">-	تحليل احصائيات خطط المشرفين والاستفادة منها في التخطيط ومتابعة المدارس الأولى بالرعاية.</li>
                        <li class="list-group-item textJustify">-	تسهيل عملية ادخال خطط المشرفين دون تعارض .</li>
                        <li class="list-group-item textJustify">-	الاستفادة من تقنية المعلومات في تقليص إجراءات اعداد تكاليف خطط المشرفين الأسبوعية.</li>
                        <li class="list-group-item textJustify">-	الحصول على المعلومات بأقل جهد ووقت من خلال الفلاتر المتنوعة بالمنصة.</li>
                        {{-- <li class="list-group-item">item</li> --}}
                    </ul>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="{{ asset('backend/img/sweeklyplan.jpg') }}" width="45%" class="img-circle elevation-2" alt="Product Image">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="bg-light py-5" dir="rtl" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4" style="color:#014bae">المميزات</h2>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	موقع الكتروني بمواصفات عالية من حيث المساحة والخدمات وأنظمة الأمان Secure Sockets Layer (SSL) .</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	تم بناء الموقع على أساس تعدد صلاحيات المستخدمين حسب طبيعة مهمة الأعضاء المسجلين بالموقع.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	منع تعارض زيارة أكثر من مشرف للمدرسة الواحدة مع المرونة لصاحب الصلاحية.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	إمكانية ادخال صاحب الصلاحية مهمة لكل المشرفين في يوم محدد مثل البرامج التدريبية والأيام المكتبية.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	تخزين البيانات وعمل نسخ احتياطية لقاعدة البيانات بشكل يومي والكتروني ذاتياً من خلال النظام.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	النظام شامل ويلبي احتياجات كل مكاتب التعليم والإدارة التعليمية الأخرى.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	إمكانية إدارة المستخدمين ، الخطط ، المهام ، المهام الفرعية ...الخ من حيث العرض والبحث والاضافة والتحديث والحذف.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	إمكانية الحصول على ملف Excel و PDF للبيانات المخزنة على النظام .</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	إمكانية التحقق من الخطط المدخل المكتملة والغير مكتملة قبل اصدار التكاليف .</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	سهولة استخدام الموقع وسرعته وذلك لأنه صمم بتقنية Livewire & Single Page .</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	واجهة Front End سهلة الاستخدام للمشرفين وأخرى عبارة عن Dashboard لصاحب الصلاحية بالإدارة أو مكتب التعليم.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Feature 1</h5> --}}
                            <p class="card-text textJustify">-	تمييز المدارس الأولى بالرعاية حتى يسهل متابعتها.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-5" dir="rtl" data-aos="fade-up">
        <div class="container">
            <h2 class="text-center mb-4" style="color:#014bae">راسلنا</h2>
            <div class="row">
                <div class="col-lg-6 mx-auto">

                    @if (session()->has('success'))
                        <div class="alert alert-success" id="success-alert">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label" style="color:#014bae">الإسم</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="اكتب الاسم الرباعي">

                            @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label" style="color:#014bae">البريد الالكتروني</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="ادخل عنوان بريد الكتروني صالح">

                            @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label" style="color:#014bae">نص الرسالة</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" name="message" id="message" rows="4" placeholder="اكتب رسالة مختصرة وواضحة.."></textarea>

                            @error('message')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        {{-- g-recaptcha-response --}}
                        <div class="mb-3">
                            <input type="hidden" class="form-control @error('g-recaptcha-response') is-invalid @enderror" name="g-recaptcha-response" id="g-recaptcha-response" required>

                            @error('g-recaptcha-response')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="button" onclick="onClick(event)" class="btn btn-primary">ارسل</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        <p>&copy; 2023 sweeklyplan.com All rights reserved.</p>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('backend/plugins/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    {{-- AOS library --}}
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    {{-- RECAPTCHA V3 --}}
    <script src="https://www.google.com/recaptcha/api.js?render={{ config('services.recaptcha.site_key') }}"></script>
    <script>
        function onClick(e) {
            e.preventDefault();
            grecaptcha.ready(function() {
            grecaptcha.execute('{{ config('services.recaptcha.site_key') }}', {action: 'register'}).then(function(token) {
                document.getElementById("g-recaptcha-response").value = token;
                document.getElementById("contactForm").submit();
            });
            });
        }
    </script>

    <script>
        $(document).ready(function() {
        // Wait for the document to be ready
        setTimeout(function() {
            // Hide the alert after 3 minutes (180,000 milliseconds)
            $("#success-alert").alert("close");
        }, 5000);
        });
    </script>

    <script>
        AOS.init();
    </script>
</body>

</html>
