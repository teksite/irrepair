<?php

namespace Modules\Announcement\Http\Controllers\Web\Panel\Announcements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Announcement\Http\Logics\AnnouncementsLogic;
use Modules\Announcement\Http\Logics\UserAnnouncementsLogic;
use Modules\Announcement\Models\Announcement;
use Modules\Main\Services\Facade\WebResponse;

class AnnouncementsController extends Controller implements HasMiddleware
{
    public function __construct(public UserAnnouncementsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:client-announcement-read'),
        ];
    }

    public function index()
    {
        $result = $this->logic->getAllAnnouncements();
        $pinnedAnnouncements = $result->data['pinned'];
        $announcements = $result->data['all'];

        return view('announcement::pages.panel.announcements.index', compact('pinnedAnnouncements', 'announcements'));
    }


    public function show(Announcement $announcement)
    {
        $this->logic->markAsRead([$announcement->id]);
        return view('announcement::pages.panel.announcements.show', compact('announcement'));
    }



    public function markAsRead()
    {
        $result =$this->logic->markAsRead();
        return WebResponse::byResult($result)->go();
    }

}
