@component('layout', [
    'chartData' => $chartData,
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
                    <th>Date</th>
                    <th>Touchés</th>
                    <th>Morts</th>
                    <th>Rétablies</th>
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
                    /** @var \Illuminate\Support\Collection $chartData */
                    $data = $chartData->reverse()->values();
                @endphp

                @for($i = 0; $i < $data->count(); $i++)
                    <tr>
                        <td> {{$data[$i]->date->format('d/m/Y')}}</td>
                        <td>
                            {{$data[$i]->confirmed}}
                            @isset($data[$i+1])
                                <span class="delta">({{ delta($data[$i]->confirmed, $data[$i+1]->confirmed) }})</span>
                            @endisset
                        </td>
                        <td>
                            {{$data[$i]->deaths}}
                            @isset($data[$i+1])
                                <span class="delta">({{ delta($data[$i]->deaths, $data[$i+1]->deaths) }})</span>
                            @endisset
                        </td>
                        <td>
                            {{$data[$i]->recovered}}
                            @isset($data[$i+1])
                                <span class="delta">({{ delta($data[$i]->recovered, $data[$i+1]->recovered) }})</span>
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
                    href="https://github.com/ExpDev07/coronavirus-tracker-api"
                    target="_blank" rel="noopener noreferrer"
                >https://github.com/ExpDev07/coronavirus-tracker-api</a>
            </p>
        </div>
    </div>
@endcomponent
