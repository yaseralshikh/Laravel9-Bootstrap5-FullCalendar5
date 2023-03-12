<?php

namespace App\Http\Livewire;

use App\Models\Event;
use App\Models\Feature;
use App\Models\JobType;
use App\Models\Semester;
use App\Models\Specialization;
use App\Models\Task;
//use App\Models\Office;
use App\Models\User;
//use App\Rules\WeekRule;
use App\Models\Week;
use App\Rules\EventOverLap;
use App\Rules\UserOverLap;
use Carbon\Carbon;
//use App\Rules\SemesterRule;
use Illuminate\Support\Facades\Validator;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Calendar extends Component
{
    use LivewireAlert;

    public $data = [];

    public $all_user;
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
                'name' => 'required',
                'email' => 'required|email|unique:users,email,' . $this->userProfile->id,
                'office_id' => 'nullable',
                'specialization_id' => 'required',
                'type' => 'required',
                'edu_type' => 'required',
                'status' => 'required',
                'email_verified_at' => 'nullable',
                'password' => 'sometimes|confirmed',
            ])->validate();

            if (!empty($validatedData['password'])) {
                $validatedData['password'] = bcrypt($validatedData['password']);
            }

            if ($validatedData['email'] != $this->userProfile->email) {
                $validatedData['email_verified_at'] = null;
                $emailVerifiedMessage = true;
                $this->userProfile->sendEmailVerificationNotification();
            }

            $this->userProfile->update($validatedData);

            $this->dispatchBrowserEvent('hide-profile');

            $this->alert('success', __('site.updateSuccessfully') . ($emailVerifiedMessage ? ' <p dir="rtl"> <br> ' . __('site.emailVerifiedMessage') . '</p>' : ''), [
                'position' => 'top-end',
                'timer' => 4000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);

        } catch (\Throwable$th) {
            $message = $this->alert('error', $th->getMessage(), [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'text' => null,
                'showCancelButton' => false,
                'showConfirmButton' => false,
            ]);
            return $message;
        }
    }
    // End update user profile

    protected function rules(): array
    {
        return ([
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

        $semester_Id = Semester::where('start', '<=', $this->start)->where('end', '>=', $this->end)->pluck('id')->first();
        $week_Id = Week::where('start', '<=', $this->start)->where('end', '>=', $this->end)->pluck('id')->first();

        if ($semester_Id && $week_Id) {
            if ($this->all_user) {

                $users = User::where('office_id', auth()->user()->office_id)->whereStatus(1)->get();

                foreach ($users as $user) {
                    Event::create([
                        'user_id' => $user->id,
                        'office_id' => $user->office_id,
                        'semester_id' => $semester_Id,
                        'week_id' => $week_Id,
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
                    'semester_id' => $semester_Id,
                    'week_id' => $week_Id,
                    'task_id' => $this->task_id,
                    'start' => $this->start,
                    'end' => $this->end,
                    'color' => $color,
                ]);
            }

            $this->reset();
            $this->resetErrorBag();
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

        } else {
            $this->dispatchBrowserEvent('swal', [
                'title' => 'اليوم المحدد غير مطابق للفصل الدراسي',
                'timer' => 3500,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'center',
            ]);
        }
    }

    public function update()
    {
        $this->data = [
            'office_id' => $this->office_id,
            'task_id' => $this->task_id,
            'start' => $this->start,
            'end' => $this->end,
        ];

        $validatedData = Validator::make($this->data, [
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

        $semester_Id = Semester::where('start', '<=', $this->start)->where('end', '>=', $this->end)->pluck('id')->first();
        $week_Id = Week::where('start', '<=', $this->start)->where('end', '>=', $this->end)->pluck('id')->first();

        if ($semester_Id && $week_Id) {

            $validatedData['office_id'] = auth()->user()->office_id;
            $validatedData['semester_id'] = $semester_Id;
            $validatedData['week_id'] = $week_Id;
            $validatedData['task_id'] = $this->task_id;
            $validatedData['start'] = $this->start;
            $validatedData['end'] = $this->end;
            $validatedData['color'] = $color;

            Event::findOrFail($this->event_id)->update($validatedData);

            $this->reset();
            $this->resetErrorBag();
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

        } else {

            $this->dispatchBrowserEvent('swal', [

                'title' => 'اليوم المحدد غير مطابق للفصل الدراسي',
                'timer' => 3500,
                'icon' => 'error',
                'toast' => true,
                'showConfirmButton' => false,
                'position' => 'center',

            ]);
        }
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

    public function eventDrop($event, $oldEvent)
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
                    ->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة','برنامج تدريبي','يوم مكتبي','مكلف بمهمة']);})
                    ->count() <= 0;

                if ($eventOverLap) {

                    $eventStart = Carbon::create($event['start'])->toDateString();
                    $eventEnd = Carbon::create($event['end'])->toDateString();

                    $week_Id = Week::where('start', '<=', $eventStart)->where('end', '>=', $eventEnd)->pluck('id')->first();

                    if ($week_Id) {

                        $eventdata->start = $eventStart;
                        $eventdata->end = $eventEnd;
                        $eventdata->week_id = $week_Id;

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
                            'title' => 'اليوم المحدد غير مطابق للفصل الدراسي',
                            'timer' => 3500,
                            'icon' => 'error',
                            'toast' => true,
                            'showConfirmButton' => false,
                            'position' => 'center',
                        ]);
                    }

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

        $this->resetErrorBag();
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function render()
    {
        $tasks = Task::where('office_id', auth()->user()->office_id)->whereStatus(1)->orderBy('level_id', 'asc')->orderBy('name', 'asc')->get();

        $specializations = Specialization::whereStatus(true)->orderBy('name', 'asc')->get();

        $featureValue = Feature::where('office_id', auth()->user()->office_id)->where('title', 'قفل إدخال الخطط')->first();

        $jobs_type = JobType::whereStatus(true)->get();

        $educationTypes = [
            [
                'id' => 1,
                'title' => 'الشؤون التعليمية',
            ],
            [
                'id' => 2,
                'title' => 'الشؤون المدرسية',
            ],
        ];

        return view('livewire.calendar', compact(
            'tasks',
            'specializations',
            'jobs_type',
            'educationTypes',
            'featureValue',
        ));
    }
}
