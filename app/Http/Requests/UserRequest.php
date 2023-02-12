<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
       switch ($this->method()){
           case "POST":
               return [
                   'name'     => 'required|max:255',
                   'email'    => 'required|email|unique:users',
                   'roles'    => 'required',
                   'password' => 'required|min:6|confirmed',
                   'password_confirmation' => 'required|min:6'
               ];
                break;
           case "PATCH" :
               return [
                   'name'     => 'required|max:255',
                   'email'    => 'required|email|unique:users,id,'.$this->user,
                   'roles'    => 'required',
                   'password' => 'nullable|min:6|confirmed'
               ];
               break;
           default:
               return [
                   'name'     => 'required|max:255',
                   'email'    => 'required|email|unique:users',
                   'roles'    => 'required',
                   'password' => 'required|min:6|confirmed',
                   'password_confirmation' => 'required|min:6'
               ];
       }
    }
}
