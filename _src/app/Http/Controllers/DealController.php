<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexDealRequest;
use App\Http\Requests\StoreDealRequest;
use App\Http\Requests\UpdateDealRequest;
use App\Models\Deal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class DealController extends Controller
{
    /**
     * @param \App\Http\Requests\IndexDealRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexDealRequest $request): JsonResponse
    {
        $deals = Deal::where('product_id', $request->input('product_id'))->get();

        return response()->json([
            'status' => 'success',
            'data' => $deals,
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\StoreDealRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDealRequest $request): JsonResponse
    {
        $deal = Deal::create($request->validated());

        Log::info('Сделка создана', [
            'deal_id' => $deal->id,
            'product_id' => $deal->product_id,
            'client_name' => $deal->client_name,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Сделка успешно создана',
            'data' => $deal->load('product'),
        ], Response::HTTP_CREATED);
    }

    /**
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Deal $deal): JsonResponse
    {
        return response()->json([
            'status' => 'success',
            'data' => $deal->load('product'),
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Http\Requests\UpdateDealRequest $request
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateDealRequest $request, Deal $deal): JsonResponse
    {
        $deal->update($request->validated());

        Log::info('Сделка обновлена', [
            'deal_id' => $deal->id,
            'status' => $deal->status,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Сделка успешно обновлена',
            'data' => $deal->fresh()->load('product'),
        ], Response::HTTP_OK);
    }

    /**
     * @param \App\Models\Deal $deal
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\Response
     */
    public function destroy(Deal $deal)
    {
        $dealId = $deal->id;
        $productId = $deal->product_id;
        $clientName = $deal->client_name;

        $deal->delete();

        Log::info('Сделка удалена', [
            'deal_id' => $dealId,
            'product_id' => $productId,
            'client_name' => $clientName,
        ]);

        return response()->json(['ok' => true], Response::HTTP_OK);
    }
}
