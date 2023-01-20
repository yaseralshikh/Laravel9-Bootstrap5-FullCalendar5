<?php

namespace App\Rules;

use App\Models\Event;
use Illuminate\Contracts\Validation\Rule;

class UserOverLap implements Rule
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
        return Event::where('start', $this->start)
            ->where('user_id', auth()->user()->id)
            ->count() == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'لا يمكن ادخال اكثر من مهمة لنفس المستخدم بنفس اليوم.';
    }
}
