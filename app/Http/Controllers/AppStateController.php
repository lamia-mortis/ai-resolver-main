<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class AppStateController extends Controller
{
    /**
     * @var array<message:string,backTrace:string>
     */
    public function saveLogs(Request $request): JsonResponse
    {
        $errorInfo = $request->post();
        Log::debug($errorInfo['message'] ?? '', [$errorInfo['backTrace'] ?? '']);
        return response()->json(['success' => true]);
    }
}
