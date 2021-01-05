@php
use \App\Support\Number;
@endphp

@component('layout', [
    'chartData' => $chartData,
    'tableData' => $tableData,
    'country' => $country,
])
    @slot('title'){{ $country }}@endslot

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable({!! $chartData->toJson() !!});
            var options = {
                title: 'Nombre de cas de Covid-19: {{ $country }}',
                curveType: 'function',
                legend: {position: 'bottom'},
                height: '700',
                lineWidth: 3,
                isStacked: true,
                series: {
                    0: {color: '#e2431e'},
                    1: {color: '#1c91c0'},
                    2: {color: '#6f9654'},
                },
                vAxis: {
                    viewWindowMode: 'explicit',
                    viewWindow: {
                        min: 0
                    }
                }
            };
            var chart = new google.visualization.AreaChart(document.getElementById('graph'));
            chart.draw(data, options);
        }
    </script>

    <div class="full-height">
        <div class="flex-center">
            <p><a href="{{ route('home') }}">Tous les pays</a></p>
        </div>

        <div id="graph"></div>
        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <td>Date</td>
                    <td>Touchés</td>
                    <td>Morts</td>
                    <td>Rétablies</td>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <td>Date</td>
                    <td>Touchés</td>
                    <td>Morts</td>
                    <td>Rétablies</td>
                </tr>
                </tfoot>
                <tbody>
                @php
                    /** @var \Illuminate\Support\Collection $tableData */
                    $data = $tableData->reverse()->values();
                @endphp

                @for($i = 0; $i < $data->count(); $i++)
                    <tr>
                        <td> {{$data[$i]->date->format('d/m/Y')}}</td>
                        <td>
                            {{ Number::format($data[$i]->confirmed) }}
                            @isset($data[$i+1])
                                <span class="delta">({{ Number::delta(value1: $data[$i]->confirmed, value2: $data[$i+1]->confirmed, format_output: true) }})</span>
                            @endisset
                        </td>
                        <td>
                            {{ Number::format($data[$i]->deaths) }}
                            @isset($data[$i+1])
                                <span class="delta">({{ Number::delta(value1: $data[$i]->deaths, value2: $data[$i+1]->deaths, format_output: true) }})</span>
                            @endisset
                        </td>
                        <td>
                            {{ Number::format($data[$i]->recovered) }}
                            @isset($data[$i+1])
                                <span class="delta">({{ Number::delta(value1: $data[$i]->recovered, value2: $data[$i+1]->recovered, format_output: true) }})</span>
                            @endisset
                        </td>
                    </tr>
                @endfor
                </tbody>
            </table>
        </div>

        <div class="flex-center">
            <p>
                Source de données: <a
                    href="https://documenter.getpostman.com/view/10808728/SzS8rjbc"
                    target="_blank" rel="noopener"
                >https://documenter.getpostman.com/view/10808728/SzS8rjbc</a>
            </p>
        </div>
    </div>
@endcomponent
