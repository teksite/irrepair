<x-main::admin-layout>
    <form action="{{route('admin.forms.analytics.show')}}" method="GET">
        <x-main::box class="flex items-center gap-6 mb-12">
            <div>
                <x-main::input.label  for="fromDate" :value="__('from date')"/>
                <x-main::input.date  id="fromDate" name="fromDate" type="date" value="{{$startDate->format('Y-m-d')}}"/>
            </div>
            <div>
                <x-main::input.label  for="toDate" :value="__('until date')"/>
                <x-main::input.date  id="toDate" name="toDate" type="date" value="{{$endDate->format('Y-m-d')}}"/>
            </div>
            <div>
                <x-main::input.label  for="range" :value="__('range')"/>
                <x-main::input.select  id="range" name="range">
                    <option value="month" {{$range=='month' ? 'selected' :''}}>{{__('month')}}</option>
                    <option value="year" {{$range=='year' ? 'selected' :''}}>{{__('year')}}</option>
                    <option value="week" {{$range=='week' ? 'selected' :''}}>{{__('week')}}</option>
                    <option value="day" {{$range=='day' ? 'selected' :''}}>{{__('day')}}</option>

                </x-main::input.select>
            </div>
            <div class="self-end">
                <x-main::button.primary >
                    {{__('search')}}
                </x-main::button.primary>
            </div>
        </x-main::box>

    </form>
    <div>
        <canvas id="myChart"></canvas>
    </div>
    @push('footerScripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: {!! $label !!},
                    datasets: {!! $dataSet !!}
                },
                options: {
                    animations: {
                        tension: {
                            duration: 1000,
                            easing: 'linear',
                            from: 1,
                            to: 0,
                            loop: true
                        }
                    },
                    scales: {
                        y: {
                            ticks: {
                                precision: 0,  // Round to whole numbers
                                beginAtZero: true // Start y-axis at 0
                            }

                        }
                    }
                }
            });
        </script>
    @endpush
</x-main::admin-layout>
