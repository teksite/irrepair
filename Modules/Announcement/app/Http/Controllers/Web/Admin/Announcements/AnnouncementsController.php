<?php

namespace Modules\Announcement\Http\Controllers\Web\Admin\Announcements;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Modules\Announcement\Http\Logics\AnnouncementsLogic;
use Modules\Announcement\Http\Requests\Admin\AnnouncementRequest;
use Modules\Announcement\Models\Announcement;
use Modules\Main\Services\Facade\WebResponse;

class AnnouncementsController extends Controller implements HasMiddleware
{
    public function __construct(public AnnouncementsLogic $logic)
    {

    }

    public static function middleware(): array
    {
        return [
            new Middleware('can:announcement-read'),
            new Middleware('can:announcement-create', only: ['create', 'store']),
            new Middleware('can:announcement-edit', only: ['edit', 'update']),
            new Middleware('can:announcement-delete', only: ['destroy']),
        ];
    }

    public function index()
    {

        $results = $this->logic->getAllAnnouncements();
        $announcements = $results->data;
        return view('announcement::pages.admin.announcements.index', compact('announcements'));
    }


    public function create()
    {
        return view('announcement::pages.admin.announcements.create');
    }


    public function store(AnnouncementRequest $request)
    {
        $result = $this->logic->registerAnnouncement($request->validated());
        return WebResponse::byResult($result, 'admin.announcements.index')->go();
    }


    public function show(Announcement $announcement)
    {
        return view('announcement::pages.admin.announcements.show', compact('announcement'));
    }


    public function edit(Announcement $announcement)
    {
        abort(404);
    }


    public function update(Request $request, Announcement $announcement)
    {
        abort(404);

    }


    public function destroy(Announcement $announcement)
    {
        $result = $this->logic->destroyAnnouncement($announcement);
        return WebResponse::redirect()->byResult($result, 'admin.announcements.index')->go();
    }
}
