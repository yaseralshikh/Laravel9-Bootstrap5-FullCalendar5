<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use App\Models\Office;
use App\Rules\WeekRule;
use Livewire\Component;
use App\Models\Semester;
use App\Rules\UserOverLap;
use App\Rules\EventOverLap;
use App\Rules\SemesterRule;
use App\Models\Specialization;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Calendar extends Component
{
    use LivewireAlert;

    public $data = [];

    public $all_user;
    public $semester_id;
    public $week_id;
    public $office_id;
    public $task_id;
    public $start;
    public $end;
    public $event_id;

    public $weeks = [];

    // update User Profile

    public $profileData = [];
    public $userProfile;

    public function editProfile(User $user_profile)
    {
        $this->reset('profileData');

        $this->userProfile = $user_profile;

        $this->profileData = $user_profile->toArray();

        $this->dispatchBrowserEvent('show-profile');
    }

    public function updateProfile()
    {
        try {
            $emailVerifiedMessage = null;

            $validatedData = Validator::make($this->profileData, [
                'name'                      => 'required',
                'email'                     => 'required|email|unique:users,email,'.$this->userProfile->id,
                'office_id'                 => 'nullable',
                'specialization_id'         => 'required',
                'type'                      => 'required',
                'edu_type'                  => 'required',
                'status'                    => 'required',
                'email_verified_at'         => 'nullable',
                'password'                  => 'sometimes|confirmed',
            ])->validate();

            if(!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            if($validatedData['email'] !=$this->userProfile->email){
                $validatedData['email_verified_at'] = null;
                $emailVerifiedMessage = true;
                $this->userProfile->sendEmailVerificationNotification();
            }

            $this->userProfile->update($validatedData);

            $this->dispatchBrowserEvent('hide-profile');

            $this->alert('success', __('site.updateSuccessfully') . ($emailVerifiedMessage ? ' <p dir="rtl"> <br> ' . __('site.emailVerifiedMessage') . '</p>' : '') , [
                'position'  =>  'top-end',
                'timer'  =>  4000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);

            $emailVerifiedMessage = null;

        } catch (\Throwable $th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position'  =>  'top-end',
                'timer'  =>  3000,
                'toast'  =>  true,
                'text'  =>  null,
                'showCancelButton'  =>  false,
                'showConfirmButton'  =>  false
            ]);
            return $message;
        }
    }
    // End update user profile

    protected function rules(): array
    {
        return ([
            'semester_id' => ['required', new SemesterRule($this->start)],
            'week_id' => ['required', new WeekRule($this->start)],
            'task_id' => ['required', new EventOverLap($this->start), new UserOverLap($this->start)],
        ]);
    }

    public function resetErrorMsg()
    {
        $this->resetErrorBag();
    }

    public function save()
    {
        $this->validate();

        $color = null;

        switch ($this->task_id) {
            case 1:
                $color = '#000000';
                break;
            case 2:
                $color = '#cf87fa';
                break;
            case 3:
                $color = '#eb6c0c';
                break;
            default:
                $color = '#298A08';
        }

        if ($this->all_user) {
            $users = User::where('office_id', auth()->user()->office_id)->whereStatus(1)->get();
            foreach ($users as $user) {
                Event::create([
                    'user_id' => $user->id,
                    'office_id' => $user->office_id,
                    'semester_id' => $this->semester_id,
                    'week_id' => $this->week_id,
                    'task_id' => $this->task_id,
                    'start' => $this->start,
                    'end' => $this->end,
                    'color' => $color,
                    'status' => 1,
                ]);
            }
        } else {
            Event::create([
                'user_id' => auth()->user()->id,
                'office_id' => auth()->user()->office_id,
                'semester_id' => $this->semester_id,
                'week_id' => $this->week_id,
                'task_id' => $this->task_id,
                'start' => $this->start,
                'end' => $this->end,
                'color' => $color,
            ]);
        }

        $this->reset();
        $this->dispatchBrowserEvent('closeModalCreate', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => __('site.saveSuccessfully'),
            'timer' => 2000,
            'icon' => 'success',
            'showConfirmButton' => false,
            'toast' => true,
            'position' => 'center',
        ]);
    }

    public function update()
    {
        $this->data = [
            'semester_id' => $this->semester_id,
            'week_id' => $this->week_id,
            'office_id' => $this->office_id,
            'task_id' => $this->task_id,
            'start' => $this->start,
            'end' => $this->end,
        ];

        $validatedData = Validator::make($this->data, [
            'semester_id' => ['required', new SemesterRule($this->start)],
            'week_id' => ['required', new WeekRule($this->start)],
            'task_id' => ['required', new EventOverLap($this->start)],
        ])->validate();

        $color = null;

        switch ($this->task_id) {
            case 1:
                $color = '#000000';
                break;
            case 2:
                $color = '#cf87fa';
                break;
            case 3:
                $color = '#eb6c0c';
                break;
            default:
                $color = '#298A08';
        }

        $validatedData['office_id'] = auth()->user()->office_id;
        $validatedData['semester_id'] = $this->semester_id;
        $validatedData['week_id'] = $this->week_id;
        $validatedData['task_id'] = $this->task_id;
        $validatedData['start'] = $this->start;
        $validatedData['end'] = $this->end;
        $validatedData['color'] = $color;

        Event::findOrFail($this->event_id)->update($validatedData);

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => __('site.updateSuccessfully'),
            'timer' => 2000,
            'icon' => 'success',
            'toast' => true,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    public function delete()
    {
        Event::findOrFail($this->event_id)->delete();

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => __('site.deleteSuccessfully'),
            'timer' => 3000,
            'icon' => 'success',
            'toast' => true,
            'showConfirmButton' => false,
            'position' => 'center',
        ]);
    }

    public function eventDrop($event)
    {
        $eventdata = Event::find($event['id']);
        if (($eventdata->user_id == auth()->user()->id) || (auth()->user()->roles[0]->id != 3)) {
            if ($eventdata->status && auth()->user()->roles[0]->id == 3) {
                $this->dispatchBrowserEvent('swal', [
                    'title' => 'تم اعتماد المهمة ، لا يمكن التعديل الا بعد فك الاعتماد من المكتب',
                    'timer' => 4000,
                    'icon' => 'error',
                    'toast' => true,
                    'showConfirmButton' => false,
                    'position' => 'center',
                ]);
            } else {

                $eventOverLap = Event::where('task_id', $eventdata->task_id)
                    ->where('start', $event['start'])
                    ->whereNotIn('task_id', [1,2,3])
                    ->count() <= 1;

                if ($eventOverLap) {
                    $eventStart = Carbon::create($event['start'])->toDateString();
                    $eventEnd = Carbon::create($event['end'])->toDateString();

                    $eventdata->start = $eventStart;
                    $eventdata->end = $eventEnd;
                    $eventdata->save();

                    $this->dispatchBrowserEvent('swal', [
                        'title' => __('site.updateSuccessfully'),
                        'timer' => 2000,
                        'icon' => 'success',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'position' => 'center',
                    ]);
                } else {
                    $this->dispatchBrowserEvent('swal', [
                        'title' => 'تم حجز الزيارة في هذا الموعد لنفس المدرسة من قبل مشرفين أخرين.',
                        'timer' => 3500,
                        'icon' => 'error',
                        'toast' => true,
                        'showConfirmButton' => false,
                        'position' => 'center',
                    ]);
                }
            }
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'لا تملك الصلاحية للتعديل !!',
                'timer' => 2000,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'center',
            ]);
        }

        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    // Get Semester Active
    // public function semesterActive()
    // {
    //     $semester_active = Semester::where('active' ,1)->get();
    //     return $semester_active[0]->id;
    // }

    public function semesterOption($option)
    {
        if ($option) {
            $this->weeks = Week::whereStatus(1)->where('semester_id', $option)->get();
        } else {
            $this->weeks = Week::whereStatus(1)->get();
        }

    }

    public function booted()
    {
        $this->weeks = Week::whereStatus(1)->get();
    }

    public function render()
    {
        $semesters = Semester::whereStatus(1)->get();
        $weeks = Week::whereStatus(1)->get();
        $tasks = Task::where('office_id', auth()->user()->office_id)->whereStatus(1)->get();

        $specializations = Specialization::whereStatus(true)->get();
        $offices = Office::whereStatus(true)->get();

        $types = [
            [
                'id'    => 1,
                'title' => 'مشرف تربوي'
            ],
            [
                'id'    => 2,
                'title' => 'تقنية المعلومات'
            ],
            [
                'id'    => 3,
                'title' => 'مساعد مدير المكتب للشؤون التعليمية'
            ],
            [
                'id'    => 4,
                'title' => 'مساعد مدير المكتب للشؤون المدرسية'],
            [
                'id'    => 5,
                'title' => 'مدير مكتب التعليم'
            ]
        ];

        $educationTypes = [
            [
                'id'    => 1,
                'title' => 'الشؤون التعليمية'
            ],
            [
                'id'    => 2,
                'title' => 'الشؤون المدرسية'
            ]
        ];

        return view('livewire.calendar', compact(
            'tasks',
            'weeks',
            'semesters',
            'specializations',
            'offices',
            'types',
            'educationTypes',
        ));
    }
}
