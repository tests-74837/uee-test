<?php

namespace App\Http\Requests;

use App\Context\CompanyData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'StoreCompanyRequest',
    properties: [
        new OA\Property(
            property: 'name',
            type: 'string',
            example: 'ТОВ Українська енергетична біржа',
            nullable: false,
        ),
        new OA\Property(
            property: 'edrpou',
            type: 'string',
            example: "37027819",
            nullable: false,
        ),
        new OA\Property(
            property: 'address',
            type: 'string',
            example: '01001, Україна, м. Київ, вул. Хрещатик, 44',
            nullable: false,
        ),
    ],
)]
class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'edrpou' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:9999'],
        ];
    }

    public function getCompanyData(): CompanyData
    {
        $data = $this->validated();

        return new CompanyData(
            name: $data['name'],
            edrpou: $data['edrpou'],
            address: $data['address'],
        );
    }
}
