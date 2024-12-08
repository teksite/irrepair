<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;

class BatchJobsController extends Controller implements HasMiddleware
{
    public array $files = [];

    public function __construct()
    {
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }


    public function index()
    {
        $batches = DB::table('job_batches')->get();
        return view('main::pages.admin.settings.batch-jobs', compact('batches'));
    }


    public function retry($id)
    {
          $batch=Bus::findBatch($id);
          if ($batch) Artisan::call("queue:retry-batch $id");
          return redirect()->back();
    }

    public function cancel($id)
    {
        $batch=Bus::findBatch($id);
        if ($batch) $batch->cancel();
        return redirect()->back();
    }



    public function destroy($id)
    {
        $batch=Bus::findBatch($id);

        if ($batch) {
            $batch->cancel();
            $batch->delete();
        }
        return redirect()->back();

    }
}
