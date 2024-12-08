<?php

namespace Modules\Theme\Http\Controllers\Web\Client\Files;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class DownloadFilesController extends Controller
{
    public function download(Request $request)
    {
        if (!URL::hasValidSignature($request)) abort(419);

        $validated = $request->validate([
            'url' => 'sometimes|string',
            'file' => 'sometimes|string'
        ]);
        if (isset($validated['url']) && $validated['url']) {
            return redirect()->to($validated['url']);

        }

        if (isset($validated['file']) && $validated['file']) {
            $path = storage_path('app/downloads/' . $validated['file']);
            return response()->download($path);
        }

        abort(404);

    }
}
