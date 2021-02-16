<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
        $course = Course::whereUid($this->course)->first('uid');
        
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'title' => ['required', 'string', 'max:255', 'unique:courses'],
                    'category_id' => ['required', 'string'],
                    'details' => ['required', 'string'],
                    'duration' => ['required', 'numeric'],
                    'cost' => ['nullable', 'numeric'],
                    'discount' => ['nullable', 'numeric'],
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }
            case 'PUT':
            {
                return [
                    'title' => 'required|string|max:255|unique:courses,'.$course->id,
                    'category_id' => ['required', 'string'],
                    'details' => ['required', 'string'],
                    'duration' => ['required', 'numeric'],
                    'cost' => ['nullable', 'numeric'],
                    'discount' => ['nullable', 'numeric'],
                    'photo'=>'nullable|mimes:jpeg,jpg,png|max:800', //Max 800KB
                ];
            }            
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'category_id.required' => 'Course category is required',
            'title.required' => 'Course title is required',
            'title.unique' => 'This course already exist',
            'details.required' => 'Course details is required',
            'duration.required' => 'Course duration is required',
        ];
    }
}
