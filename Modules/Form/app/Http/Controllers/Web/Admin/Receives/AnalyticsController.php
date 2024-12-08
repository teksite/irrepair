<?php

namespace Modules\Form\Http\Controllers\Web\Admin\Receives;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Carbon;
use Modules\Form\Models\Form;
use Modules\Form\Models\FormInbox;

class AnalyticsController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [new Middleware('can:form-receive-read')];
    }

    public function show(Request $request)
    {
        $forms = Form::all();
        [$startDate, $endDate, $range] = $this->getDateRangeAndType($request);

        $dateRange = $this->generateDateRange($startDate, $endDate, $range);
        $data = $this->prepareDataSet($forms, $dateRange);

        $labelArray = $this->generateLabels($dateRange);
        $label = json_encode($labelArray);
        $dataSet = json_encode($data['dataset']);

        return view('form::pages.admin.analytics.show', compact('startDate', 'endDate', 'range', 'data', 'label', 'dataSet'));
    }

    private function getDateRangeAndType(Request $request): array
    {
        $startDate = $request->get('fromDate') ? Carbon::create($request->get('fromDate')) : Carbon::now()->startOfMonth();
        $endDate = $request->get('toDate') ? Carbon::create($request->get('toDate')) : Carbon::now()->endOfMonth();
        $range = $request->get('range') ?? 'month';

        return [$startDate, $endDate, $range];
    }

    private function generateDateRange(Carbon $startDate, Carbon $endDate, string $range): array
    {
        $dateRange = [];
        $currentDate = $startDate->copy();

        while ($currentDate->lte($endDate)) {
            $dateRange[] = $currentDate->format('Y-m-d');
            $currentDate->add($this->getDateInterval($range));
        }

        if (end($dateRange) != $endDate->format('Y-m-d')) {
            $dateRange[] = $endDate->format('Y-m-d');
        }

        return $dateRange;
    }

    private function getDateInterval(string $range): \DateInterval
    {
        return match ($range) {
            'year' => new \DateInterval('P1Y'),
            'week' => new \DateInterval('P1W'),
            'day' => new \DateInterval('P1D'),
            default => new \DateInterval('P1M')
        };
    }

    private function prepareDataSet($forms, $dateRange): array
    {
        $data = ['dataset' => []];

        foreach ($forms as $j => $form) {
            $data['dataset'][$j]['label'] = $form->title;
            $data['dataset'][$j]['data'] = $this->countInboxesForDateRanges($form, $dateRange);
            $data['dataset'][$j]['borderWidth'] = 1;
        }

        return $data;
    }

    private function countInboxesForDateRanges($form, $dateRange): array
    {
        $data = [];

        for ($i = 0; $i < count($dateRange) - 1; $i++) {
            $data[] = $form->inboxes()->whereBetween('created_at', [$dateRange[$i], $dateRange[$i + 1]])->count();
        }

        return $data;
    }

    private function generateLabels($dateRange): array
    {
        $labels = [];

        for ($i = 0; $i < count($dateRange) - 1; $i++) {
            $labels[] = "{$dateRange[$i]} - {$dateRange[$i + 1]}";
        }

        return $labels;
    }
}
