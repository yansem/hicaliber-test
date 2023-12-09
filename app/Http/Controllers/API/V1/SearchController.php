<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class SearchController extends Controller
{
    public function __invoke(SearchRequest $request): AnonymousResourceCollection
    {
        $data = $request->validated();
        $houses = House::withSearch($data)->get();
        return HouseResource::collection($houses);
    }
}
