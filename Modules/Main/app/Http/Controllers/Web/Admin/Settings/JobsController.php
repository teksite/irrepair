<?php

namespace Modules\Main\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Queue;
use Modules\Main\Http\Logics\LogLogic;

class JobsController extends Controller implements HasMiddleware
{
    public array $files = [];

    public function __construct(public LogLogic $logic)
    {
        $this->files = $this->logic->getLogFiles()->data;
    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:setting-edit'),
        ];
    }


    public function index()
    {
        $table=request()->input('table' ,'failed_jobs');
        $jobs = DB::table($table)->get();

        return view('main::pages.admin.settings.jobs', compact('jobs'));
    }


    public function reload($uuid)
    {
        $failedJob = DB::table('failed_jobs')->where('uuid', $uuid)->first();
        if ($failedJob) {
            $payload = json_decode($failedJob->payload, true);
            $command = unserialize($payload['data']['command']);
            // Dispatch the job again
                dispatch($command);
            //           Artisan::call("queue:retry $uuid");


        }
    }


    public function show($id)
    {
        return view('main::show');
    }


    public function destroy($id)
    {
       $batch=Bus::findBatch($id);
       dd($batch);
    }
}
