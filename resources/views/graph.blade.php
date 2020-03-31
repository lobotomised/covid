@component('layout', [
    'chartData' => $chartData,
    'country' => $country
])

    <script type="text/javascript">
        google.charts.load('current', {'packages': ['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable({!! $chartData !!});
            var options = {
                title: 'Nombre de cas de Covid-19: {{ $country }}',
                curveType: 'function',
                legend: {position: 'bottom'},
                height: '700',
                lineWidth: 3,
                isStacked: true,
                series: {
                    2: {color: '#1c91c0'},
                    0: {color: '#e2431e'},
                    1: {color: '#6f9654'},
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
