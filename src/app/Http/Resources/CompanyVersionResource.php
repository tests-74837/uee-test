<?php

namespace App\Http\Resources;

use App\Models\CompanyVersion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Attributes as OA;

#[OA\Schema(
    schema: 'CompanyVersionResource',
    properties: [
        new OA\Property(
            property: 'version',
            description: 'data version',
            type: 'integer',
            example: 1,
            nullable: false
        ),
        new OA\Property(
            property: 'name',
            description: 'company name',
            type: 'string',
            nullable: false
        ),
        new OA\Property(
            property: 'address',
            description: 'company address',
            type: 'string',
            nullable: false
        )
    ]
)]
/** @property-read CompanyVersion $resource */
class CompanyVersionResource extends JsonResource
{
    public static $wrap = null;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'version' => $this->resource->version,
            'name' => $this->resource->name,
            'address' => $this->resource->address,
        ];
    }
}
