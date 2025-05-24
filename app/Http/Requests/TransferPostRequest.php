<?php

namespace App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class TransferPostRequest extends FormRequest
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
            'amount.regex' => 'The amount must be a valid number with up to two decimal places.',
            'recipient_account_number.digits' => 'The recipient account number must be exactly 4 digits.',
            'exists' => 'That account number does not exist. Please check it and try again'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Request $request): array
    {
        $user = auth()->user();
        $bankAccount = $user->bankAccount;

        return [
            'recipient_account_number' => [
                'required',
                'integer',
                'digits:4',
                'exists:bank_accounts,account_number',
            ],
            'amount' => [
                'required',
                'numeric',
                'lte:' . $bankAccount->balance,
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
        ];

    }
}
