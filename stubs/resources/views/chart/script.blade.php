<script>
    var options =
    {
        chart: {
            type: '{!! $chart->type() !!}',
            height: {!! $chart->height() !!},
            width: '{!! $chart->width() !!}',
            toolbar: {!! $chart->toolbar() !!},
            zoom: {!! $chart->zoom() !!},
            fontFamily: '{!! $chart->fontFamily() !!}',
            foreColor: '{!! $chart->foreColor() !!}',
            events: {
                animationEnd: function (chartContext){
                    chartContext.dataURI().then(({ imgURI, blob }) => {
                        chartsDataURIs['{!! $chart->chartKey() !!}'] = imgURI;
                    });
                },
                /*beforeMount: function (chartContext){
                    console.log("beforeMount"+chartContext.paper().svg())
                },
                mounted: function (chartContext){
                    console.log("Mounted"+chartContext.paper().svg())
                },*/
                updated: function (chartContext){
                    chartContext.dataURI().then(({ imgURI, blob }) => {
                        chartsDataURIs['{!! $chart->chartKey() !!}'] = imgURI;
                    });
                },
            }
        },
        plotOptions: {
            bar: {!! $chart->horizontal() !!},
            radialBar: {!! $chart->radialBar() !!}
        },
        colors: {!! $chart->colors() !!},
        series: {!! $chart->dataset() !!},
        dataLabels: {!! $chart->dataLabels() !!},
        @if($chart->labels())
            labels: {!! json_encode($chart->labels(), true) !!},
        @endif
        title: {
            text: "{!! $chart->title() !!}"
        },
        subtitle: {
            text: '{!! $chart->subtitle() !!}',
            align: '{!! $chart->subtitlePosition() !!}'
        },
        xaxis: {
            categories: {!! $chart->xAxis() !!}
        },
        grid: {!! $chart->grid() !!},
        markers: {!! $chart->markers() !!},
        @if($chart->stroke())
            stroke: {!! $chart->stroke() !!},
        @endif
        noData: {
            text: "N/A",
            align: "center",
            verticalAlign: "middle",
        },
    }

    var chart = new ApexCharts(document.querySelector("#{!! $chart->id() !!}"), options);
    chart.render();
    charts.push(chart);
</script>
