<?php

namespace App\Http\Resources;

use App\Enums\StatusEnum;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenAPI\Attributes as OA;

#[OA\Schema(
    schema: 'CompanyResource',
    properties: [
        new OA\Property(
            property: 'status',
            description: 'request status',
            type: 'string',
            nullable: false,
            enum: ['created', 'updated', 'duplicate']
        ),
        new OA\Property(
            property: 'id',
            description: 'company id',
            type: 'integer',
            nullable: false
        ),
        new OA\Property(
            property: 'version',
            description: 'data version',
            type: 'integer',
            nullable: false
        )
    ]
)]
/**
 * @property-read Company $resource
 */
class CompanyResource extends JsonResource
{
    public static $wrap = null;

    private StatusEnum $status;

    public function __construct(Company $company, StatusEnum $status)
    {
        $this->status = $status;

        parent::__construct($company);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'status' => $this->status->value,
            'id' => $this->resource->id,
            'version' => $this->resource->currentVersion->version,
        ];
    }
}
