<?php

namespace App\Rules;

use App\Models\member;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class Checkpassword implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        $member = member::find(session('id'));
        if(Hash::check($value,$member->password)){
            return $value;
        }
            return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'รหัสผ่านเดิมไม่ถูกต้อง';
    }
}
