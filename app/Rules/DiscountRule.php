<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DiscountRule implements Rule
{
    
    protected $type;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    public function __construct($type)
    {
        $this->type = $type; 
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
        if (($this->type == 'percent') && ($value % 5 !=0)) {
            return false;
        } 
        
        else if (($this->type == 'page') && ($value > 2)) {
            return false;
        } 
        else if ((!$this->type) && (isset($value))) {
            return false;
        } 
        else {
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
        if ($this->type == 'percent') {

            return 'For percentage discounts, you can only issue 5, 10 or 15';
        }

        else if ($this->type == 'page') {

            return 'For page discounts, maximum discount is 2 pages';
            }
        else 
            return 'Select a discount type';
    }
}
