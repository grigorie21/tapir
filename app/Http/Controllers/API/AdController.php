<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\AdPostRequest;
use App\Http\Resources\API\Ad\AdResource;
use App\Jobs\ImageUpload;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdController extends Controller
{
    /**
     * Получить все объявления с сортировкой
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $model = Ad::with('images');
        $direction = $request->get('direction');
        $sort = $request->get('sort');

        if (in_array($sort, ['created_at', 'cost'])) {
            if (in_array($direction, ['ASC', 'DESC'])) {
                $model->orderBy($sort, $direction);
            } else {
                $model->orderBy($sort, 'ASC');
            }
        }

        $model = $model->paginate(10);

        return AdResource::collection($model);
    }

    /**
     * Получить одно объявление
     *
     * @param Ad $model
     * @return AdResource|\Illuminate\Http\JsonResponse
     */
    public function get(Ad $model)
    {
        if ($model) {
            return new AdResource($model);
        } else {
            return response()->json(['error' => 'No page'], 404);
        }
    }

    /**
     * Получить все объявления
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function all()
    {
        $model = Ad::paginate(10);

        return AdResource::collection($model);
    }

    /**
     * Создать объявление
     *
     * @param AdPostRequest $request
     * @return AdResource|\Illuminate\Http\JsonResponse
     */
    public function post(AdPostRequest $request)
    {
        DB::beginTransaction();

        try {
            $imagePaths = $request->get('images');

            $model = Ad::create($request->all());

            $this->dispatch(new ImageUpload($imagePaths, $model));

            DB::commit();

            return new AdResource($model);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
