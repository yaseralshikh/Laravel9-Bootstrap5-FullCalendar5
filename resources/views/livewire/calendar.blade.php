<div>

    @push('styles')
        <style>

        </style>
    @endpush

    {{-- Calender --}}
    <div id="calendar" wire:ignore></div>

    {{-- Create Event Modal --}}
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="createModalLabel">Create New Event</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save">
                        <div class="mb-3">
                            <label for="title" class="col-form-label">Title:</label>
                            <input type="text" wire:model.defer="title" class="form-control @error('title') is-invalid @enderror" id="title">
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

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Event Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Edit Event</h1>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update">
                        <div class="mb-3">
                            <label for="title1" class="col-form-label">Title:</label>
                            <input type="text" wire:model.defer="title" class="form-control @error('title') is-invalid @enderror" id="title1">
                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            {{-- <label for="start1" class="col-form-label">Start:</label> --}}
                            <input type="date" wire:model.defer="start" class="form-control" id="start1">
                        </div>

                        <div class="mb-3">
                            {{-- <label for="end1" class="col-form-label">End:</label> --}}
                            <input type="date" wire:model.defer="end" class="form-control" id="end1">
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
                    @this.title = '';
                    @this.start = '';
                    @this.end = '';
                });

                const editModalEl = document.getElementById('editModal');
                editModalEl.addEventListener('hidden.bs.modal', event => {
                    @this.event_id = '';
                    @this.title = '';
                    @this.start = '';
                    @this.end = '';
                });

                const calendarEl = document.getElementById('calendar');
                const checkbox = document.getElementById('drop-remove');
                const tooltip = null;
                const calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'dayGridMonth',
                    timeZone: 'local',
                    locale: 'ar-sa',
                    displayEventTime : false,
                    weekNumbers: true,
                    hiddenDays: [ 5,6 ],
                    //weekends: false,
                    //firstDay:0,
                    //themeSystem: 'bootstrap5',
                    dayMaxEvents: 4, // allow "more" link when too many events
                    selectable: true,
                    droppable: true, // this allows things to be dropped onto the calendar
                    editable: true,

                    select: function({startStr,endStr}){
                        @this.start = startStr;
                        @this.end = endStr;
                        $('#createModal').modal('toggle');
                    },

                    eventClick: function({event}) {
                        @this.event_id = event.id;
                        @this.title = event.title;
                        @this.start = dayjs(event.startStr).format('YYYY-MM-DD');
                        @this.end = dayjs(event.endStr).format('YYYY-MM-DD');
                        $('#editModal').modal('toggle');
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
                            title: info.event.title + '<br />' + info.event.extendedProps.user_id,
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
                                if (e.source === null) {
                                    e.remove();
                                }
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
