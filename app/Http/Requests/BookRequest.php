<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        switch ($this->method()) {
            case "POST":
            {
                return [
                    "name" => "required|max:140|unique:books",
                    "isbn" => "required|max:140|unique:books",
                    "summary" => "nullable|string|min:20|max:140",
                    "author" => "required|max:120"
                ];
            }
            case "PUT":
            {
                return [
                    "name" => "required|unique:books,name," . $this->route("book"),
                    "isbn" => "required|max:140|unique:book"  . $this->route("book"),
                    "summary" => "nullable|string|min:20|max:140",
                    "author" => "required|max:120"
                ];
            }
            default: {
                return [];
            }
        }
    }
}
