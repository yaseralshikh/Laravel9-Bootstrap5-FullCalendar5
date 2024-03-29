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

        /* .fc .fc-daygrid-day-frame {
            background-color: rgb(236, 236, 236);
        } */
    </style>
    @endpush

    <div class="alert alert-success" dir="rtl" role="alert">
        <h4 class="alert-heading">ملاحظة :</h4>
        <ul class="list-group list-group-flush">
            <li>الالتزام بإعداد الخطة الاسبوعية قبل نهاية دوام كل يوم ثلاثاء من كل اسبوع دراسي.</li>
            <li>مراعاة عدم حضور اكثر من مشرفين في المدرسة الواحدة.</li>
            <li>الالتزام بالأيام المكتبية المتفق عليها حسب تعليمات إدارة المكتب.</li>
            <li>التعديل عند اللزوم قبل اعتماد الخطط.</li>
        </ul>
        <hr>
        <p class="mb-0">مع تحيات ادارة مكتب التعليم بوسط جازان - بنين.</p>
    </div>

    {{-- Calender --}}
    <div id="calendar" wire:ignore></div>

    {{-- Create Event Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create New Event</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <!-- Week -->
                        <div class="mb-3">
                            <label for="week_id" class="form-label">{{ __('School Week') }} :</label>
                            <select name="week_id" wire:model.defer="week_id"
                                class="form-select  @error('week_id') is-invalid @enderror" id="week_id">
                                <option value="" selected>@lang('site.choise') :</option>
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}" style="{{ $week->active ? 'color: blue;' : '' }}">{{
                                    $week->title . ' ( ' . $week->semester->school_year . ' )' }}</option>
                                @endforeach
                            </select>

                            @error('week_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="col-form-label">المهمة:</label>
                            {{-- <input type="text" wire:model.defer="title"
                                class="form-control @error('title') is-invalid @enderror" id="title"> --}}
                            <select name="title" wire:model.defer="title"
                                class="form-select  @error('title') is-invalid @enderror" id="title">
                                <option value="" selected>@lang('site.choise') :</option>
                                @foreach ($schools as $school)
                                <option value="{{ $school->name }}">{{ $school->name }}</option>
                                @endforeach
                            </select>
                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="start" class="col-form-label">Start:</label> --}}
                            <input type="hidden" wire:model.defer="start" class="form-control" id="start">
                        </div>

                        <div class="mb-3">
                            {{-- <label for="end" class="col-form-label">End:</label> --}}
                            <input type="hidden" wire:model.defer="end" class="form-control" id="end">
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                            @role('admin|superadmin')
                            <div class="form-check">
                                <input class="form-check-input" wire:model.defer="all_user" type="checkbox" value=""
                                    id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Event for All users
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
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Event</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <!-- Week -->
                        <div class="mb-3">
                            <label for="week_id_1" class="col-form-label">School Week :</label>

                            <select wire:model.defer="week_id"
                                class="form-select  @error('week_id') is-invalid @enderror" id="week_d_1">
                                @foreach ($weeks as $week)
                                <option value="{{ $week->id }}">{{ $week->title . ' ( ' . $week->semester->school_year .
                                    ' )' }}</option>
                                @endforeach
                            </select>

                            @error('week_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title1" class="col-form-label">Title:</label>
                            <select wire:model.defer="title" class="form-select  @error('title') is-invalid @enderror"
                                id="title1">
                                @foreach ($schools as $school)
                                <option value="{{ $school->name }}">{{ $school->name }}</option>
                                @endforeach
                            </select>

                            @error('title')
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
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary">Update</button>
                            </div>
                            <button class="btn btn-danger" wire:click.prevent='delete'>Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @push('script')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const createModalEl = document.getElementById('createModal');
            createModalEl.addEventListener('hidden.bs.modal', event => {
                @this.week_id = '';
                @this.title = '';
                @this.start = '';
                @this.end = '';
            });

            const editModalEl = document.getElementById('editModal');
            editModalEl.addEventListener('hidden.bs.modal', event => {
                @this.event_id = '';
                @this.week_id = '';
                @this.title = '';
                @this.start = '';
                @this.end = '';
            });

            const calendarEl = document.getElementById('calendar');
            const checkbox = document.getElementById('drop-remove');
            const tooltip = null;
            const userID = {{ auth()->user()->id }};
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
                weekNumbers: true,
                hiddenDays: [ 5,6 ],
                //weekends: false,
                //firstDay:0,
                //themeSystem: 'bootstrap5',
                dayMaxEvents: 5, // allow "more" link when too many events
                //selectable: true,
                selectable: false,
                droppable: true, // this allows things to be dropped onto the calendar
                editable: true,

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
                            @this.event_id  = event.id;
                            @this.week_id   = event.extendedProps.week_id;
                            @this.title     = event.title;
                            @this.start     = dayjs(event.startStr).format('YYYY-MM-DD');
                            @this.end       = dayjs(event.endStr).format('YYYY-MM-DD');
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
                //         title: info.event.title,
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
                        title: info.event.extendedProps.week.title + ' ( ' + info.event.extendedProps.week.semester.school_year  + ' ) ' + '<br />' + info.event.title + '<br />'+ '<span class="text-info">' + info.event.extendedProps.user.name + '</span>' + '<br />' + '<span class="text-warning">' + (info.event.extendedProps.status == 1 ? 'تم الاعتماد' : '' + '</span>'),
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
                }

            });

            calendar.addEventSource({
                url: '/api/calendar/events'
            });

            calendar.render();

            document.addEventListener('closeModalCreate', function({detail}) {
                if (detail.close) {
                    $('#createModal').modal('toggle');
                }
            });

            document.addEventListener('closeModalEdit', function({detail}) {
                if (detail.close) {
                    $('#editModal').modal('toggle');
                }
            });

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

            window.addEventListener('swal',function(e){
                Swal.fire(e.detail);
            });
        });
    </script>
    @endpush
</div>
