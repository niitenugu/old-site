<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
        $category = Category::whereUid($this->category)->first('uid');
        
        switch ($this->method()) {
            case 'POST':
            {
                return [
                    'name' => ['required', 'string', 'max:255', 'unique:categories'],
                ];
            }
            case 'PUT':
            {
                return [
                    'name' => 'required|string|max:255"unique:categories,'.$category->id,
                ];
            }            
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Category name is required',
            'name.unique' => 'This category already exist',
        ];
    }
}
