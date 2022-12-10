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

        Event::create([
            'user_id' => auth()->user()->id,
            'semester' => $this->semester,
            'title'   => $this->title,
            'start'   => $this->start,
            'end'     => $this->end,
            'color'     => '#298A08',
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('closeModalCreate', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Event Saved',
            'timer'=>2000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
    }

    public function update()
    {
        $this->validate();

        Event::findOrFail($this->event_id)->update([
            'semester'  => $this->semester,
            'title'     => $this->title,
            'start'     => $this->start,
            'end'       => $this->end,
        ]);


        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Event updated',
            'timer'=>2000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
    }

    public function delete()
    {
        Event::findOrFail($this->event_id)->delete();

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Event deleted',
            'timer'=>3000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
    }

    public function eventDrop($event)
    {
        $eventStart =  Carbon::create($event['start'])->toDateString();
        $eventEnd =  Carbon::create($event['end'])->toDateString();

        $eventdata = Event::find($event['id']);
        $eventdata->start = $eventStart;
        $eventdata->end = $eventEnd;
        $eventdata->save();
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
        $this->dispatchBrowserEvent('swal', [
            'title' => 'Event updated',
            'timer'=>2000,
            'icon'=>'success',
            'toast'=>true,
            'position'=>'center'
        ]);
    }

    public function render()
    {
        $schools = School::all();
        $semesterItems = ['ألفصل الدراسي الأول','الفصل الدراسي الثاني','الفصل الدراسي الثالث'];
        return view('livewire.calendar', compact('schools','semesterItems'));
    }
}
