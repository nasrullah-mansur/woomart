<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MaxWordsRule implements Rule
{
    private $max_words;

    public function __construct($max_words = 500)
    {
        $this->max_words = $max_words;
    }


    public function passes($attribute, $value)
    {
        return str_word_count($value) <= $this->max_words;
    }

    public function message()
    {
        return 'The :attribute field cannot be longer than '.$this->max_words.' words.';
    }
}
