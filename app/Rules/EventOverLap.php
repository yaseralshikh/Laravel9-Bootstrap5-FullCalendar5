<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class EventOverLap implements Rule
{
    public $start;
    public $specialization;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start ,$specialization)
    {
        $this->start = $start;
        $this->specialization = $specialization;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $excepted_specialization_id = [4];

        if (in_array($this->specialization, $excepted_specialization_id, true)) {
            $event = Event::where('task_id', $value)->where('start', $this->start)
                ->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة','برنامج تدريبي','يوم مكتبي','مكلف بمهمة']);})
                ->count() <= 1;
        } else {
            $event = Event::where('task_id', $value)->where('start', $this->start)
            ->whereHas('task', function ($q) {$q->whereNotIn('name',['إجازة','برنامج تدريبي','يوم مكتبي','مكلف بمهمة']);})
            ->count() <= 0;
        }

        return $event ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تم حجز الزيارة في هذا الموعد لنفس المدرسة من قبل مشرف أخر.';
    }
}
