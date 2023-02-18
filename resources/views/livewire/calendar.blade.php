<div>

    @push('style')
    <style>
        .fc .fc-toolbar {
            display: flex;
            flex-wrap: wrap;
            /* justify-content: center; */
            font-size: 14px;
            background-color: rgb(243, 243, 243);
        }

        .fc .fc-col-header {
            background-color: rgb(51, 81, 133);
        }

        .fc-col-header-cell-cushion {
            color: rgb(255, 254, 254);
        }

        .fc-h-event .fc-event-main-frame {
            display: block; /* for make fc-event-title-container expand */
            padding: 0 1px;
            white-space: normal;
        }

        .fc-daygrid-event {
            white-space: normal !important;
            align-items: normal !important;
        }

        /* .fc .fc-daygrid-day-frame {
            background-color: rgb(236, 236, 236);
        } */
    </style>
    @endpush

    <div class="alert alert-success" dir="rtl" role="alert">
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button class="btn btn-dark" wire:click.prevent="editProfile({{ auth()->user()->id }})">@lang('site.profile')</button>
        </div>
        <h4 class="alert-heading">ملاحظة :</h4>
        <ul class="list-group list-group-flush">
            <li>الالتزام بإعداد الخطة الاسبوعية قبل نهاية دوام كل يوم ثلاثاء من كل اسبوع دراسي.</li>
            <li>مراعاة عدم حضور اكثر من مشرف تربوي في المدرسة الواحدة قدر الإمكان.</li>
            <li>الالتزام بالأيام المكتبية المتفق عليها حسب تعليمات إدارة المكتب.</li>
            <li>التعديل عند اللزوم قبل اعتماد الخطط.</li>
        </ul>
        <hr>
        <p class="mb-0">مع تحيات ادارة {{ auth()->user()->office->name }}.</p>
    </div>

    {{-- Calender --}}
    <div id="calendar" wire:ignore></div>

    {{-- Create Event Modal --}}
    <div dir="rtl" class="modal fade" id="createModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">@lang('site.addRecord', ['name' => 'خطة'])</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <!-- Semester -->
                        <div class="mb-3">
                            <label for="semester_id" class="form-label">{{ __('site.semester') }} :</label>
                            <select name="semester_id" wire:model.defer="semester_id"
                                wire:change="semesterOption($event.target.value)"
                                class="form-select  @error('semester_id') is-invalid @enderror" id="semester_id">
                                <option value="">@lang('site.choise', ['name' => 'ألفصل الدراسي']) :</option>
                                @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}"
                                    style="{{ $semester->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{
                                    $semester->title . ' ( ' . $semester->school_year . ' )' }}
                                </option>
                                @endforeach
                            </select>

                            @error('semester_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Week -->
                        <div class="mb-3">
                            <label for="week_id" class="form-label">{{ __('site.schoolWeek') }} :</label>
                            <select name="week_id" wire:model.defer="week_id"
                                class="form-select  @error('week_id') is-invalid @enderror" id="week_id">
                                <option value="">@lang('site.choise', ['name' => 'الأسبوع الدراسي']) :</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}"
                                    style="{{ $week->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{
                                    $week->title . ' ( ' . $week->semester->school_year . ' )' }}
                                </option>
                                @endforeach
                            </select>

                            @error('week_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Task -->
                        <div class="mb-3">
                            <label for="title" class="col-form-label">@lang('site.task') :</label>
                            {{-- <input type="text" wire:model.defer="title"
                                class="form-control @error('title') is-invalid @enderror" id="title"> --}}
                            <select name="task_id" wire:model.defer="task_id"
                                class="form-select  @error('task_id') is-invalid @enderror" id="task_id">
                                <option value="" selected>@lang('site.choise', ['name' => 'المهمة']) :</option>
                                @foreach ($tasks as $task)
                                <option value="{{ $task->id }}" style="
                                        {{ $task->level_id == 1 ? 'background:#FBEFF2;' : '' }}
                                        {{ $task->level_id == 2 ? 'background:#E6F8E0;' : '' }}
                                        {{ $task->level_id == 3 ? 'background:#F7F8E0;' : '' }}
                                        {{ $task->level_id == 4 ? 'background:#F8ECE0;' : '' }}
                                        {{ $task->level_id == 5 ? 'background:#E0F2F7;' : '' }}">
                                    {{ $task->name }}
                                </option>
                                @endforeach
                            </select>
                            @error('task_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- start -->
                        <div class="mb-3">
                            {{-- <label for="start" class="col-form-label">Start:</label> --}}
                            <input type="hidden" wire:model.defer="start" class="form-control" id="start">
                        </div>

                        <!-- end -->
                        <div class="mb-3">
                            {{-- <label for="end" class="col-form-label">End:</label> --}}
                            <input type="hidden" wire:model.defer="end" class="form-control" id="end">
                        </div>

                        {{-- Action --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-secondary" wire:click="resetErrorMsg"
                                    data-bs-dismiss="modal">@lang('site.cancel')</button>
                                <button type="submit" class="btn btn-primary">@lang('site.save')</button>
                            </div>
                            @role('admin|superadmin')
                            <div class="form-check">
                                <input class="form-check-input" wire:model.defer="all_user" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    @lang('site.eventForAllUsers')
                                </label>
                            </div>
                            @endrole
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Event Modal --}}
    <div dir="rtl" class="modal fade" id="editModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">@lang('site.updateRecord', ['name' => 'خطة'])</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <!-- Semester -->
                        <div class="mb-3">
                            <label for="semester_id_1" class="form-label">{{ __('site.semester') }} :</label>
                            <select name="semester_id" wire:model.defer="semester_id"
                                wire:change="semesterOption($event.target.value)"
                                class="form-select @error('semester_id') is-invalid @enderror" id="semester_id_1">
                                <option value="">@lang('site.choise', ['name' => 'الفصل الدراسي'])</option>
                                @foreach ($semesters as $semester)
                                <option value="{{ $semester->id }}"
                                    style="{{ $semester->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{
                                    $semester->title . ' ( ' . $semester->school_year . ' )' }}</option>
                                @endforeach
                            </select>

                            @error('semester_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <!-- Week -->
                        <div class="mb-3">
                            <label for="week_id_1" class="col-form-label">{{ __('site.schoolWeek') }} :</label>
                            <select wire:model.defer="week_id"
                                class="form-select  @error('week_id') is-invalid @enderror" id="week_d_1">
                                <option value="">@lang('site.choise', ['name' => 'الأسبوع الدراسي'])</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}"
                                    style="{{ $week->active ? 'color: blue; background:#F2F2F2;' : '' }}">{{
                                    $week->title . ' ( ' . $week->semester->school_year . ' )' }}
                                </option>
                                @endforeach
                            </select>

                            @error('week_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="task_id1" class="col-form-label">@lang('site.task') :</label>
                            <select wire:model.defer="task_id" class="form-select  @error('task_id') is-invalid @enderror"
                                id="task_id">
                                @foreach ($tasks as $task)
                                <option value="{{ $task->id }}" style="
                                        {{ $task->level_id == 1 ? 'background:#FBEFF2;' : '' }}
                                        {{ $task->level_id == 2 ? 'background:#E6F8E0;' : '' }}
                                        {{ $task->level_id == 3 ? 'background:#F7F8E0;' : '' }}
                                        {{ $task->level_id == 4 ? 'background:#F8ECE0;' : '' }}
                                        {{ $task->level_id == 5 ? 'background:#E0F2F7;' : '' }}">
                                    {{ $task->name }}
                                </option>
                                @endforeach
                            </select>

                            @error('task_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="start1" class="col-form-label">Start:</label> --}}
                            <input type="hidden" wire:model.defer="start" class="form-control" id="start1">
                        </div>

                        <div class="mb-3">
                            {{-- <label for="end1" class="col-form-label">End:</label> --}}
                            <input type="hidden" wire:model.defer="end" class="form-control" id="end1">
                        </div>

                        <div class="d-flex justify-content-between mt-5">
                            <div>
                                <button type="button" class="btn btn-secondary" wire:click="resetErrorMsg"
                                    data-bs-dismiss="modal">@lang('site.cancel')</button>
                                <button class="btn btn-primary">@lang('site.update')</button>
                            </div>
                            <button class="btn btn-danger" wire:click.prevent='delete'>@lang('site.delete')</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Update Profile -->

    <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editProfileModalLabel">
                        <span>@lang('site.updateRecord', ['name' => 'الملف الشخصي'])</span>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent="updateProfile">
                    <div class="modal-body" dir="rtl">
                        <div class="row h-100 justify-content-center align-items-center">
                            <div class="col-12">

                                <!-- Modal User Full Name -->

                                <div class="form-group">
                                    <label for="name">@lang('site.fullName') *</label>
                                    <input type="text" wire:model.defer="profileData.name"
                                        class="form-control @error('name') is-invalid @enderror" id="name"
                                        aria-describedby="nameHelp" placeholder="@lang('site.enterFullName')">
                                    @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Email -->

                                <div class="form-group">
                                    <label for="email">@lang('site.email') *</label>
                                    <input type="email" wire:model.defer="profileData.email"
                                        class="form-control @error('email') is-invalid @enderror" id="email"
                                        aria-describedby="emailHelp" placeholder="@lang('site.enterEmail')">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Office -->

                                <div class="form-group">
                                    <label for="office_id">@lang('site.office') *</label>
                                    <select id="office_id" class="form-control @error('office_id') is-invalid @enderror"
                                        wire:model.defer="profileData.office_id">
                                        <option hidden>@lang('site.choise', ['name' => 'مكتب التعليم'])</option>
                                        @foreach ($offices as $office)
                                        <option class="bg-light" value="{{ $office->id }}">{{ $office->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('office_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Specialization -->

                                <div class="form-group">
                                    <label for="specialization_id">@lang('site.specialization') *</label>
                                    <select id="specialization_id"
                                        class="form-control @error('specialization_id') is-invalid @enderror"
                                        wire:model.defer="profileData.specialization_id">
                                        <option hidden>@lang('site.choise', ['name' => 'التخصص'])</option>
                                        @foreach ($specializations as $specialization)
                                        <option class="bg-light" value="{{ $specialization->id }}">{{
                                            $specialization->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('specialization_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Type -->

                                <div class="form-group">
                                    <label for="type">@lang('site.type') *</label>
                                    <select id="type" class="form-control @error('type') is-invalid @enderror"
                                        wire:model.defer="profileData.type">
                                        <option hidden selected>@lang('site.choise', ['name' => 'العمل الحالي'])</option>
                                        @foreach ($types as $type)
                                        <option class="bg-light" value="{{ $type['title'] }}">{{ $type['title'] }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal Education Type -->

                                <div class="form-group">
                                    <label for="edu_type">@lang('site.eduType') *</label>
                                    <select id="edu_type" class="form-control @error('edu_type') is-invalid @enderror"
                                        wire:model.defer="profileData.edu_type">
                                        <option hidden selected>@lang('site.choise', ['name' => 'المرجع الإداري'])</option>
                                        @foreach ($educationTypes as $eduType)
                                            <option class="bg-light" value="{{ $eduType['title'] }}">{{ $eduType['title'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('edu_type')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Password -->

                                <div class="form-group">
                                    <label for="password">@lang('site.password')</label>
                                    <input type="password" wire:model.defer="profileData.password"
                                        class="form-control @error('password') is-invalid @enderror" id="password"
                                        placeholder="@lang('site.enterPassword')">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>

                                <!-- Modal User Password Confirmation -->

                                <div class="form-group">
                                    <label for="passwordConfirmation">@lang('site.passwordConfirmation')</label>
                                    <input type="password" wire:model.defer="profileData.password_confirmation"
                                        class="form-control" id="passwordConfirmation"
                                        placeholder="@lang('site.enterConfirmPassword')">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="mr-1 fa fa-times"></i><span> @lang('site.cancel') </span>
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="mr-1 fa fa-save"></i><span> @lang('site.saveChanges') </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const createModalEl = document.getElementById('createModal');
            createModalEl.addEventListener('hidden.bs.modal', event => {
                @this.office_id = '';
                @this.semester_id = '';
                @this.week_id = '';
                @this.task_id = '';
                @this.start = '';
                @this.end = '';
            });

            const editModalEl = document.getElementById('editModal');
            editModalEl.addEventListener('hidden.bs.modal', event => {
                @this.event_id = '';
                @this.office_id = '';
                @this.semester_id = '';
                @this.week_id = '';
                @this.task_id = '';
                @this.start = '';
                @this.end = '';
            });

            const calendarEl = document.getElementById('calendar');
            const checkbox = document.getElementById('drop-remove');
            const tooltip = null;
            const userID = {{ auth()->user()->id }};
            const userOffice_id = {{ auth()->user()->office_id }};
            const userRole = {{ auth()->user()->roles[0]->id }};

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    right: 'title',
                    left: 'dayGridMonth,listWeek,prev,next today'
                },
                timeZone: 'local',
                locale: 'ar-sa',
                displayEventTime : false,
                //weekNumbers: true,
                hiddenDays: [ 5,6 ],
                //weekends: false,
                //firstDay:0,
                //themeSystem: 'bootstrap5',
                dayMaxEvents: 5, // allow "more" link when too many events
                //selectable: true,
                selectable: false,
                droppable: true, // this allows things to be dropped onto the calendar
                editable: true,

                eventContent: function(info) {
                    return {
                        html: '<h6 style="font-weight: bold">&nbsp&nbsp<i class="fa fa-calendar" aria-hidden="true"></i>&nbsp&nbsp'
                             + info.event.extendedProps.task.name + '</h6>' + '<span class="text-success">&nbsp&nbsp'
                             + (info.event.extendedProps.status == 1 ? '<i class="fa fa-check" aria-hidden="true"></i>' : ''
                             + '</span>')
                    }
                },

                dateClick: function(info){
                    var startDate = info.dateStr;
                    var endDate = new Date(new Date(startDate).setDate(new Date(startDate).getDate() + 1));
                    @this.start = startDate;
                    @this.end = endDate.toISOString().substr(0, 10);
                    $('#createModal').modal('toggle');
                },

                // for select multiple days
                // select: function(info){
                //     @this.start = startStr;
                //     @this.end = endStr;
                //     $('#createModal').modal('toggle');
                // },

                eventClick: function({event}) {

                    if (userID == event.extendedProps.user_id || userRole != 3) {
                        if (event.extendedProps.status && userRole == 3) {
                            Swal.fire({
                                title: 'تم اعتماد المهمة ، لا يمكن التعديل الا بعد فك الاعتماد من المكتب',
                                timer: 2000,
                                icon: 'error',
                                toast: true,
                                showConfirmButton: false,
                                position: 'center'
                            })
                        } else {
                            @this.event_id      = event.id;
                            @this.office_id     = event.extendedProps.office_id;
                            @this.semester_id   = event.extendedProps.semester_id;
                            @this.week_id       = event.extendedProps.week_id;
                            @this.task_id       = event.extendedProps.task_id;
                            @this.start         = dayjs(event.startStr).format('YYYY-MM-DD');
                            @this.end           = dayjs(event.endStr).format('YYYY-MM-DD');
                            $('#editModal').modal('toggle');
                        }
                    } else {
                        Swal.fire({
                            title: 'لا تملك الصلاحية للتعديل !!',
                            timer: 2000,
                            icon: 'error',
                            toast: true,
                            showConfirmButton: false,
                            position: 'center'
                        })
                    }

                },

                // for show Tooltips //
                // eventDidMount: function (info) {
                //     $(info.el).popover({
                //         title: info.event.task_id,
                //         placement: 'top',
                //         trigger: 'hover',
                //         //content: dayjs(info.event.startStr).format('YYYY-MM-DD'),
                //         //content: info.event.extendedProps.user_id,
                //         container: 'body',
                //     });
                //     info.el.style.backgroundColor = '#EFFBF8'
                // },

                eventMouseEnter: function (info) {
                    $(info.el).tooltip({
                        title: info.event.extendedProps.week.title + ' ( ' + info.event.extendedProps.semester.school_year  + ' ) ' + '<br />' + info.event.extendedProps.task.name + '<br />'+ '<span class="text-info">' + info.event.extendedProps.user.name + '</span>' + '<br />' + '<span class="text-warning">' + (info.event.extendedProps.status == 1 ? 'تم الاعتماد' : '' + '</span>'),
                        html: true,
                        content:'ssss',
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },

                eventMouseLeave:  function(info) {
                    if (tooltip) {
                        tooltip.dispose();
                    }
                },

                drop: function(event) {
                    // is the "remove after drop" checkbox checked?
                    if (checkbox.checked) {
                        // if so, remove the element from the "Draggable Events" list
                        event.draggedEl.parentNode.removeChild(event.draggedEl);
                    }
                },
                eventDrop: info => @this.eventDrop(info.event, info.oldEvent),
                loading: function(isLoading) {
                    if (!isLoading) {
                        // Reset custom events
                        this.getEvents().forEach(function(e){
                            if (e.source === null) { e.remove(); }
                        });
                    }
                },
            });

            // for fill calendar
            calendar.addEventSource({
                url: '/api/calendar/events'
            });

            // for render calendar
            calendar.render();

            // Listener close Modal Create
            document.addEventListener('closeModalCreate', function({detail}) {
                if (detail.close) {
                    $('#createModal').modal('toggle');
                }
            });

            // Listener close Modal Edit
            document.addEventListener('closeModalEdit', function({detail}) {
                if (detail.close) {
                    $('#editModal').modal('toggle');
                }
            });

            // Listener for refresh Calendar
            document.addEventListener('refreshEventCalendar', function({detail}) {
                if (detail.refresh) {
                    calendar.refetchEvents();
                }
            });

            // when the selected option changes, dynamically change the calendar option
            var localeSelectorEl = document.getElementById('locale-selector');
            localeSelectorEl.addEventListener('change', function() {
                if (this.value) {
                    calendar.setOption('locale', this.value);
                }
            });

            // Listener for SweetAleart
            window.addEventListener('swal',function(e){
                Swal.fire(e.detail);
            });

            // Listener for Profile
            window.addEventListener('hide-profile', function (event) {
                $('#editProfile').modal('hide');
            });
            window.addEventListener('show-profile', function (event) {
                $('#editProfile').modal('show');
            });
        });
    </script>
    @endpush
</div>
