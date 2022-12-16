<?php

namespace App\Http\Controllers;

use App\Models\MiteDrive\Files;
use Illuminate\Http\Request;

class MiteDriveController extends Controller
{
    public function checking(Request $request)
    {
        $files = Files::where('short_url', $request->short_url)->first();
        if (!$files) {
            return response()->json([
                'success' => false,
                'message' => 'Access not found',
            ]);
        }
        return response()->json([
            'success' => true,
            'message' => 'Access found',
            'data' => [
                'ip' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'otw' => 'https://ponselharian.com/st/?api=ae5dc4ef420525fcdfc05fafb330a359941c8136&url=' . 'https://mitedrive.my.id/download/' . $files->short_url,
            ]
        ]);
    }
}
