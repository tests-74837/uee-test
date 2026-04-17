<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\CompanyVersionResource;
use App\Models\Company;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: "/api/v1/companies/{edrpou}/versions",
    summary: "Get company data versions by edrpou",
    tags: ["Companies"],
    parameters: [
        new OA\Parameter(
            name: "edrpou",
            description: "Company EDRPOU code",
            in: "path",
            required: true,
            schema: new OA\Schema(type: "string"),
            example: "37027819"
        )
    ],
    responses: [
        new OA\Response(
            response: Response::HTTP_OK,
            description: 'Company created or updated successfully',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: "data",
                        type: "array",
                        items: new OA\Items(ref: "#/components/schemas/CompanyVersionResource")
                    )
                ],
            )
        ),
        new OA\Response(
            response: Response::HTTP_NOT_FOUND,
            description: "Record not found",
        )
    ]
)]
class IndexCompanyVersionsController extends Controller
{
    public function __invoke(string $edrpou)
    {
        $company = Company::query()->where('edrpou', $edrpou)
            ->with('versions')
            ->firstOrFail();

        return CompanyVersionResource::collection($company->versions);
    }
}
