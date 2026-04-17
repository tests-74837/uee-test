<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Enums\StatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Resources\CompanyResource;
use App\Models\Company;
use Illuminate\Http\Response;
use OpenApi\Attributes as OA;

#[OA\Post(
    path: "/api/v1/companies",
    summary: "Create or update a company",
    requestBody: new OA\RequestBody(
        content: new OA\JsonContent(
            ref: "#/components/schemas/StoreCompanyRequest"
        )
    ),
    tags: ["Companies"],
    responses: [
        new OA\Response(
            response: Response::HTTP_OK,
            description: 'Company created or updated successfully',
            content: new OA\JsonContent(
                ref: "#/components/schemas/CompanyResource"
            )
        ),
    ]
)]
class StoreCompanyController extends Controller
{
    public function __invoke(StoreCompanyRequest $request)
    {
        $data = $request->getCompanyData();

        $company = Company::query()
            ->where('edrpou', $data->edrpou)
            ->first();

        $status = null;

        if (null === $company) {
            $company = new Company();
            $company->edrpou = $data->edrpou;

            $status = StatusEnum::CREATED;
        }

        $company->fill($data->toArray());

        $result = $company->saveModelAndVersion();

        if($status === null && $result === true) {
            $status = StatusEnum::UPDATED;
        }elseif($status === null && $result === false) {
            $status = StatusEnum::DUPLICATE;
        }

        return new CompanyResource($company, $status);
    }
}
