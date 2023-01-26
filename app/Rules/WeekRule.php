<?php

namespace App\Rules;

use App\Models\Week;
use Illuminate\Contracts\Validation\Rule;

class WeekRule implements Rule
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
        $week = Week::findOrFail($value);
        
        $currentDate = date('Y-m-d', strtotime($this->start));

        $stratDate = date('Y-m-d', strtotime($week->start));
        $endDate = date('Y-m-d', strtotime($week->end));

        if (($currentDate >= $stratDate) && ($currentDate <= $endDate)){
            $result = true;
        }else{
            $result = false;
        }

        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'اليوم المحدد غير مطابق للأسبوع الدراسي.';
    }
}
