<?php

namespace App\Http\Livewire;

use App\Models\Event;
use Livewire\Component;
use Carbon\Carbon;

class Calendar extends Component
{
    public $title;
    public $start;
    public $end;
    public $event_id;

    protected $rules = [
        'title' => 'required',
    ];

    public function save()
    {
        $this->validate();

        Event::create([
            'user_id' => auth()->user()->id,
            'title'   => $this->title,
            'start'   => $this->start,
            'end'     => $this->end,
            'color'     => '#298A08',
        ]);

        $this->reset();
        $this->dispatchBrowserEvent('closeModalCreate', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function update()
    {
        Event::findOrFail($this->event_id)->update([
            'title'   => $this->title,
            'start'   => $this->start,
            'end'     => $this->end,
        ]);

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function delete()
    {
        Event::findOrFail($this->event_id)->delete();

        $this->dispatchBrowserEvent('closeModalEdit', ['close' => true]);
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function eventDrop($event, $oldEvent)
    {
        $eventStart =  Carbon::create($event['start'])->toDateString();
        $eventEnd =  Carbon::create($event['end'])->toDateString();

        $eventdata = Event::find($event['id']);
        $eventdata->start = $eventStart;
        $eventdata->end = $eventEnd;
        $eventdata->save();
        $this->dispatchBrowserEvent('refreshEventCalendar', ['refresh' => true]);
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
