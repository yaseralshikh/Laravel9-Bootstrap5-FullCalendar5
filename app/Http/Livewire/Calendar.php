<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Week;
use App\Models\Event;
use App\Models\School;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Calendar extends Component
{
    public $all_user;
    public $week_id;
    public $title;
    public $start;
    public $end;
    public $event_id;

    protected $rules = [
        'week_id' => 'required',
        'title' => 'required',
    ];

    public function save()
    {
        $this->validate();

        $color = null;

        switch ($this->title) {
            case "يوم مكتبي":
                $color = '#000000';
              break;
            case "برنامج تدريبي":
                $color = '#eb6c0c';
              break;
            case "إجازة مطولة":
                $color = '#cf87fa';
              break;
            default:
                $color = '#298A08';
        }
        if ($this->all_user) {
            $users = User::all();
            foreach ($users as $user) {
                Event::create([
                    'user_id'   => $user->id,
                    'week_id'   => $this->week_id,
                    'title'     => $this->title,
                    'start'     => $this->start,
                    'end'       => $this->end,
                    'color'     => $color,
                    'status'    => 1,
                ]);
            }
        } else {
            Event::create([
                'user_id' => auth()->user()->id,
                'week_id' => $this->week_id,
                'title'   => $this->title,
                'start'   => $this->start,
                'end'     => $this->end,
                'color'   => $color,
            ]);
        }



        $this->reset();
        $this->dispatchBrowserEvent('closeModalCreate', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title'             => 'Event Saved',
            'timer'             =>2000,
            'icon'              =>'success',
            'showConfirmButton' => false,
            'toast'             =>true,
            'position'          =>'center'
        ]);
    }

    public function update()
    {
        $this->validate();

        $color = null;

        switch ($this->title) {
            case "يوم مكتبي":
                $color = '#000000';
              break;
            case "برنامج تدريبي":
                $color = '#eb6c0c';
              break;
            case "إجازة مطولة":
                $color = '#cf87fa';
              break;
            default:
                $color = '#298A08';
        }

        Event::findOrFail($this->event_id)->update([
            'week_id'   => $this->week_id,
            'title'     => $this->title,
            'start'     => $this->start,
            'end'       => $this->end,
            'color'     => $color,
        ]);


        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title'                 => 'Event updated',
            'timer'                 =>2000,
            'icon'                  =>'success',
            'toast'                 =>true,
            'showConfirmButton'     => false,
            'position'              =>'center'
        ]);
    }

    public function delete()
    {
        Event::findOrFail($this->event_id)->delete();

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title'                 => 'Event deleted',
            'timer'                 =>3000,
            'icon'                  =>'success',
            'toast'                 =>true,
            'showConfirmButton'     => false,
            'position'              =>'center'
        ]);
    }

    public function eventDrop($event)
    {
        $eventdata = Event::find($event['id']);
        if (($eventdata->user_id == auth()->user()->id) || (auth()->user()->roles[0]->id != 3)) {
            if ($eventdata->status && auth()->user()->roles[0]->id == 3) {
                $this->dispatchBrowserEvent('swal', [
                    'title'                 => 'تم اعتماد المهمة ، لا يمكن التعديل الا بعد فك الاعتماد من المكتب',
                    'timer'                 =>4000,
                    'icon'                  =>'error',
                    'toast'                 =>true,
                    'showConfirmButton'     => false,
                    'position'              =>'center'
                ]);
            } else {
                $eventStart =  Carbon::create($event['start'])->toDateString();
                $eventEnd =  Carbon::create($event['end'])->toDateString();

                $eventdata->start = $eventStart;
                $eventdata->end = $eventEnd;
                $eventdata->save();

                $this->dispatchBrowserEvent('swal', [
                    'title'                 => 'Event updated',
                    'timer'                 =>2000,
                    'icon'                  =>'success',
                    'toast'                 =>true,
                    'showConfirmButton'     => false,
                    'position'              =>'center'
                ]);
            }
        } else {
            $this->dispatchBrowserEvent('swal', [
                'title'                 => 'لا تملك الصلاحية للتعديل !!',
                'timer'                 =>2000,
                'icon'                  =>'error',
                'toast'                 =>true,
                'showConfirmButton'     => false,
                'position'              =>'center'
            ]);
        }

        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function render()
    {
        $schools = School::all();
        $weeks = Week::where('status', true)->get();

        return view('livewire.calendar', compact('schools', 'weeks'));
    }
}
