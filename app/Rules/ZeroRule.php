<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class ZeroRule implements Rule
{
    
    protected $powerpointSlides;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    public function __construct($powerpointSlides)
    {
        $this->powerpointSlides = $powerpointSlides; 
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
        if (($value == $this->powerpointSlides) && ($value == 0)) {
            return false;
        } else {
            return true;
        }
        
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Specify the number of pages or powerpoint slides';
    }
}
