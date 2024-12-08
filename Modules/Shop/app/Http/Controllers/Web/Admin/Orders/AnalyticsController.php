<?php

namespace Modules\Shop\Http\Controllers\Web\Admin\Orders;

use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;
use Modules\Shop\Models\Order;

class AnalyticsController extends Controller
{
    public static function middleware(): array
    {
        return [new Middleware('can:order-read')]; // Update permission if necessary
    }

    public function show(Request $request)
    {

        $status = $request->status ?? 'paid';
        $startDate = $request->get('fromDate') ? Carbon::create($request->get('fromDate')) : Carbon::now()->startOfMonth();
        $endDate = $request->get('toDate') ? Carbon::create($request->get('toDate')) : Carbon::now()->endOfMonth();
        $range = $request->get('range') ?? 'month';

        $query = Order::query()->where('status', $status);
        $totalOrders = $query->count();
        $totalSumPrice = $query->sum('price');
        $query= $query->whereBetween('created_at', [$startDate, $endDate]);
        $totalOrdersInRange = $query->count();
        $totalSumPriceInRange = $query->sum('price');

        $periodType = match (strtolower($range)) {
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d',
        };


        $orders = $query->selectRaw("
                DATE_FORMAT(created_at, ?) as period,
                COUNT(*) as order_count,
                SUM(price) as total_price
            ", [$periodType])
            ->groupBy('period')
            ->orderBy('period')
            ->get();
        $chartData = $this->prepareChartData($orders, $range, $startDate, $endDate);
        return view('shop::pages.admin.analytics.show',
            compact('chartData', 'startDate', 'endDate', 'range' ,
            'totalOrders','totalSumPrice','totalOrdersInRange','totalSumPriceInRange',
        ));
    }

    private function prepareChartData($orders, $range, $startDate, $endDate): array
    {
        $periods = [];
        $prices = [];
        $counts = [];

        $currentDate = clone $startDate;

        // Loop through each period (day, week, month, year) and make sure all are represented
        while ($currentDate <= $endDate) {
            // Format the current date based on the range
            $period = $currentDate->format($this->getDateFormat($range));
            // Check if data exists for this period
            $order = $orders->firstWhere('period', $period);

            // If no data exists for this period, set to 0
            $periods[] = $period;
            $counts[] = $order ? $order->order_count : 0;
            $prices[] = $order ? $order->total_price : 0;

            // Increment by one unit based on the range
            switch ($range) {
                case 'day':
                    $currentDate->addDay();
                    break;
                case 'week':
                    $currentDate->addWeek();
                    break;
                case 'month':
                    $currentDate->addMonth();
                    break;
                case 'year':
                    $currentDate->addYear();
                    break;
            }
        }

        return compact('periods', 'counts', 'prices');
    }
    private function getDateFormat(string $range)
    {
        switch ($range) {
            case 'week':
                return 'Y-u'; // Week number (1-52)
            case 'month':
                return 'Y-m'; // Month (YYYY-MM)
            case 'year':
                return 'Y'; // Year (YYYY)
            case 'day':
            default:
                return 'Y-m-d'; // Day (YYYY-MM-DD)
        }
    }
}
