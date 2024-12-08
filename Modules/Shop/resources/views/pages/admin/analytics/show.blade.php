<x-main::admin-layout>
    <form action="{{ route('admin.sell.analytics.show') }}" method="GET">
        <x-main::box class="flex items-center gap-6 mb-12">
            <!-- Date Range and Other Inputs -->
            <div>
                <x-main::input.label for="fromDate" :value="__('from date')"/>
                <x-main::input.date id="fromDate" name="fromDate" type="date"
                                    value="{{ $startDate->format('Y-m-d') }}"/>
            </div>
            <div>
                <x-main::input.label for="toDate" :value="__('until date')"/>
                <x-main::input.date id="toDate" name="toDate" type="date" value="{{ $endDate->format('Y-m-d') }}"/>
            </div>
            <div>
                <x-main::input.label for="range" :value="__('range')"/>
                <x-main::input.select id="range" name="range">
                    <option value="month" {{ $range == 'month' ? 'selected' : '' }}>{{ __('month') }}</option>
                    <option value="year" {{ $range == 'year' ? 'selected' : '' }}>{{ __('year') }}</option>
                    <option value="week" {{ $range == 'week' ? 'selected' : '' }}>{{ __('week') }}</option>
                    <option value="day" {{ $range == 'day' ? 'selected' : '' }}>{{ __('day') }}</option>
                </x-main::input.select>
            </div>

            <div>
                <x-main::input.label for="status" :value="__('status')"/>
                <x-main::input.select id="status" name="status">
                    @foreach(\Modules\Shop\Enums\PaymentEnum::cases() as $paymentType)
                        <option
                            value="{{$paymentType->value}}" {{request()->status==$paymentType->value ? 'selected' : ''}}>
                            {{$paymentType->value}}
                        </option>
                    @endforeach
                </x-main::input.select>
            </div>
            <div class="self-end">
                <x-main::button.primary>{{ __('search') }}</x-main::button.primary>
            </div>
        </x-main::box>
    </form>

    <div class="my-12 p-6 border border-slate-200 rounded-lg">
        <h2>
            {{__('summery')}} :{{__(request()->status ?? 'paid')}}
        </h2>
        <div class="grid gap-6 md:grid-cols-2">
            <div>
                <div>
                    {{__('number of orders')}}: {{$totalOrders}}
                </div>
                <div>
                    {{__('total price')}}: {{number_format($totalSumPrice)}}
                </div>
            </div>
            <div>
                <div>
                    {{__('number of orders in the range')}}:{{$totalOrdersInRange}}
                </div>
                <div>
                    {{__('total price in the range')}}: {{number_format($totalSumPriceInRange)}}
                </div>
            </div>
        </div>

    </div>

    <div>
        <h3>
            {{__('chart')}} :{{__(request()->status ?? 'paid')}}
        </h3>
        <canvas id="myChart"></canvas>
    </div>

    @push('footerScripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const chartData = @json($chartData);

            const ctx = document.getElementById('myChart');
            console.log(ctx)
            const myChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: chartData.periods, // Periods (day, week, month, year)
                    datasets: [
                        {
                            label: "{{__('number of orders')}}",
                            data: chartData.counts, // Order counts
                            tension: 0.1,
                            fill: false,
                            yAxisID: 'yCount',

                        },
                        {
                            label: "{{__('total price')}}",
                            data: chartData.prices, // Total prices
                            tension: 0.1,
                            fill: false,
                            yAxisID: 'ySum',

                        }
                    ]
                },
                options: {
                    responsive: true,
                    title: {
                        display: true,
                        text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false,
                    },
                    scales: {
                        x: {
                            title: {
                                display: false,
                                text: "{{__('period')}}",
                            }

                        },
                        yCount: {
                            type: 'linear',
                            position: 'left',
                            min:0,
                            title: {
                                display: true,
                                text: "{{__('number of orders')}}",
                            },
                            ticks: {
                                // forces step size to be 50 units
                                stepSize: 1
                            },
                            grid: {
                                drawOnChartArea: true, // Ensures no overlap
                            }

                        },
                        ySum: {
                            type: 'linear',
                            position: 'right',
                            min:0,
                            title: {
                                display: true,
                                text: "{{__('total price')}}",
                            },
                            grid: {
                                drawOnChartArea: true, // Ensures no overlap
                            }
                        }
                    }
                }
            });
        </script>
    @endpush

</x-main::admin-layout>
