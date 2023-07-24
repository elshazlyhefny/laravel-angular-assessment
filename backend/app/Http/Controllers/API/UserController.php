<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\DataProviderXService;
use App\Services\DataProviderYService;
use App\Http\Requests\UserIndexRequest;
use App\Http\Resources\DataProviderXResource;
use App\Http\Resources\DataProviderYResource;

class UserController extends Controller
{
    public function index(UserIndexRequest $request, DataProviderXService $dataProviderXService, DataProviderYService $dataProviderYService)
    {
        $provider = $request->query('provider');
        $statusCode = $request->query('statusCode');
        $balanceMin = $request->query('balanceMin');
        $balanceMax = $request->query('balanceMax');
        $currency = $request->query('currency');
        $usersX = [];
        $usersY = [];
        // Filter users based on the given criteria
        $filters = [];
        if ($statusCode !== null) {
            $filters['statusCode'] = $statusCode;
        }
        if ($currency !== null) {
            $filters['currency'] = $currency;
        }
        if ($balanceMin !== null) {
            $filters['balanceMin'] = $balanceMin;
        }
        if ($balanceMax !== null) {
            $filters['balanceMax'] = $balanceMax;
        }
        // Fetch data from services based on the filters
        if ($provider === 'DataProviderX' || $provider === null || $provider === 'both') {
            $usersX = DataProviderXResource::collection($dataProviderXService->filterUsers($filters))->resolve();
        }
        if ($provider === 'DataProviderY'|| $provider === null || $provider === 'both') {
            $usersY = DataProviderYResource::collection($dataProviderYService->filterUsers($filters))->resolve();
        }
        // Combine and return the filtered results
        $users = array_merge($usersX, $usersY);

        return response()->json($users);
    }
}
