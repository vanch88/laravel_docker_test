<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class HealthController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function check(): JsonResponse
    {
        $status = [
            'status' => 'ok',
            'timestamp' => now()->format('Y-m-d H:i:s'),
            'checks' => [
                'application' => 'ok',
                'database' => 'unknown',
            ],
        ];

        try {
            DB::connection()->getPdo();
            $status['checks']['database'] = 'ok';
        } catch (\Exception $e) {
            $status['status'] = 'error';
            $status['checks']['database'] = 'error';
            $status['error'] = $e->getMessage();
            
            return response()->json($status, 503);
        }

        return response()->json($status, 200);
    }
}
