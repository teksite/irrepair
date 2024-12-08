<?php

namespace Modules\Announcement\Http\Logics;

use App\Models\User;
use Modules\Announcement\Events\NewAnnouncementEvent;
use Modules\Announcement\Models\Announcement;
use Modules\Main\Action\FetchServiceData;
use Modules\Main\Action\ServiceResult;
use Modules\Main\Action\ServiceWrapper;
use Modules\Main\Models\Role;
use Modules\Main\Traits\Trash\HasTrash;
use Illuminate\Support\Arr;



class AnnouncementsLogic
{
     use HasTrash;
     const model = Announcement::class;

    public function getAllAnnouncements()
    {
        return app(ServiceWrapper::class)(function () {
            return app(FetchServiceData::class)(Announcement::class, ['title']);
        });
    }

    public function registerAnnouncement(array $inputs): ServiceResult
    {
        return app(ServiceWrapper::class)(function () use ($inputs) {
            $creator= auth()->user();

            $data['title'] = $inputs['title'];
            $data['message'] = $inputs['message'];
            $data['creator_id'] = $creator->id;
            $data['pinned'] = isset($inputs['pinned']);

            $data['info'] = [
                'creator' => [
                    'id' => $creator->id,
                    'name' => $creator->name,
                    'email' => $creator->email,
                    'phone' => $creator->phone,
                    'ip' => request()->ip(),
                ],
                'target' => [
                  $inputs['target'] =>$inputs['users'] ?? $inputs['roles'] ?? '',
                ],
               'routes'=> $inputs['routes'],
            ];

            $announcement = Announcement::query()->create($data);

            event(new NewAnnouncementEvent($announcement ,$inputs));

            return $announcement;
        });
    }

    public function destroyAnnouncement(Announcement $announcement)
    {
        return app(ServiceWrapper::class)(fn() => $announcement->delete());
    }

}
