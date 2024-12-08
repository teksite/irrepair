<?php

namespace Modules\Announcement\Http\Logics;

use App\Models\User;
use Illuminate\Support\Carbon;
use Modules\Announcement\Events\NewAnnouncementEvent;
use Modules\Announcement\Models\Announcement;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Role;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class UserAnnouncementsLogic
{
    public function getAllAnnouncements()
    {
        return app(ServiceWrapper::class)(function () {
            $user = auth()->user();

            $pinnedAnnouncements = $user->announcements()
                ->where('pinned', true)
                ->orderByPivot('read_at', 'asc')
                ->latest()
                ->get();

            $announcementsQuery = $user->announcements()->latest();
            if (request()->status && request()->status == 'seen') {
               $announcementsQuery->wherePivotNotNull('read_at');
            }else{
                $announcementsQuery->wherePivotNull('read_at');
            }

            $announcements = $announcementsQuery->take(20)->get();

            return ['pinned' => $pinnedAnnouncements, 'all' => $announcements];
        });
    }

    public function markAsRead(array $announcementIds = ['*'])
    {
        return app(ServiceWrapper::class)(function () use ($announcementIds) {
            $query = auth()->user()->announcements()->wherePivot('read_at', null);
            if ($announcementIds != ['*']) $query =$query->whereIn('id', $announcementIds);
            $query->update(['read_at' => Carbon::now()]);
        });
    }

}
