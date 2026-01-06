<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\StatisticRepository;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    public function __construct(private readonly StatisticRepository $repository) {}

    public function __invoke(Request $request)
    {
        return response()->json($this->repository->getStatistic());
    }
}
