<?php

namespace Modules\Form\Http\Logics;

use App\Exports\FormInboxesExport;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Form\Models\FormInbox;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;

class ExportsLogic
{
    public function export(array $input) : ServiceWrapper|ServiceResult
    {
        $filename='receives-'.Carbon::now()->format('Y_m_d_H_i_s').'.xlsx';
        return app(ServiceWrapper::class)(function () use ($filename ,$input) {

            $query =FormInbox::query()
                ->when(isset($input['form']),function($query) use ($input){
                    return $query->where('form_id',$input['form']);
                })
                ->when(isset($input['date']['start']),function($query) use ($input){
                    return $query->whereDate('created_at','>=',$input['date']['start']);
                })
                ->when(isset($input['date']['end']),function($query) use ($input){
                    return $query->whereDate('created_at','<=',$input['date']['end']);
                });
            return Excel::download(new FormInboxesExport($query), $filename);
        } ,hasTransaction:false);
    }

}
