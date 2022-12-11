<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\School;
use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Calendar extends Component
{
    public $semester;
    public $title;
    public $start;
    public $end;
    public $event_id;

    protected $rules = [
        'semester' => 'required',
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

        Event::create([
            'user_id' => auth()->user()->id,
            'semester' => $this->semester,
            'title'   => $this->title,
            'start'   => $this->start,
            'end'     => $this->end,
            'color'     => $color,
        ]);

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
            'semester'  => $this->semester,
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

        if ($eventdata->status) {
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

        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function render()
    {
        $schools = School::all();
        $semesterItems = ['ألفصل الدراسي الأول','الفصل الدراسي الثاني','الفصل الدراسي الثالث'];
        return view('livewire.calendar', compact('schools','semesterItems'));
    }
}
