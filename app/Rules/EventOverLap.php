<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class EventOverLap implements Rule
{
    public $start;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($start)
    {
        $this->start = $start;
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
        $event = Event::where('title', $value)
            ->where('start', $this->start)
            ->whereNotIn('title',['إجازة','يوم مكتبي','برنامج تدريبي'])
            ->count() == 0;

        return $event ;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'تم حجز الزيارة في هذا الموعد لنفس المدرسة من قبل مشرف اخر.';
    }
}
