<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class WithdrawPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'amount.lte' => 'You do not have enough balance to make this transfer.',
            'amount.regex' => 'The amount must be a valid number with up to two decimal places, no currency symbol.',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        //dd($request->all());
        $user = auth()->user();
        $bankAccount = $user->bankAccount;

        return [
            'amount' => [
                'required',
                'numeric',
                'lte:' . $bankAccount->balance,
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ];
    }
}
