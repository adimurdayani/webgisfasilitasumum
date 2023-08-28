@push('js-scripts')
<!-- Dashboar 1 init js-->
<script src="{{ asset('assets') }}/libs/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('assets') }}/libs/apexcharts/apexcharts.min.js"></script>
<script src="https://apexcharts.com/samples/assets/irregular-data-series.js"></script>
<script src="https://apexcharts.com/samples/assets/ohlc.js"></script>

<script src="{{ asset('assets') }}/libs/selectize/js/standalone/selectize.min.js"></script>
@endpush

@push('page-scripts')
<script>
    Apex.grid = { padding: { right: 0, left: 0 } }, Apex.dataLabels = { enabled: !1 };
    var randomizeArray = function(e) { for (var o, t, a = e.slice(), r = a.length; 0 !== r;) t = Math.floor(Math.random() * r), o = a[--r], a[r] = a[t], a[t] = o; return a },
    sparklineData = [47, 45, 54, 38, 56, 24, 65, 31, 37, 39, 62, 51, 35, 41, 35, 27, 93, 53, 61, 27, 54, 43, 19, 46],
    colorPalette = ["#00D8B6", "#008FFB", "#FEB019", "#FF4560", "#775DD0"],
    colors = ["#6658dd"];
    var colors=["#f1556c"];
    colors = ["#6658dd", "#4fc6e1", "#4a81d4", "#00b19d", "#f1556c"];

    (dataColors = $("#apex-pie-1").data("colors")) && (colors = dataColors.split(","));
    options = { 
        chart: { 
            height: 320, 
            type: "pie" 
        }, series: [
            @foreach ($visitor_browser as $brows)
                {!! $brows->total !!},
            @endforeach
        ], 
        labels: [
            @foreach ($visitor_browser as $brows)
                "{!! $brows->browser !!}",
            @endforeach
        ], 
        colors: colors, 
        legend: { 
            show: !0, 
            position: "bottom",
            horizontalAlign: "center", 
            verticalAlign: "middle", 
            floating: !1, 
            fontSize: "14px", 
            offsetX: 0, 
            offsetY: 7 
        }, 
        responsive: [
            { 
                breakpoint: 600, 
                options: { 
                    chart: { 
                        height: 240 
                    }, 
                    legend: { 
                        show: !1 
                    } 
                } 
            }
        ] 
    };
    (chart = new ApexCharts(document.querySelector("#apex-pie-1"), options)).render();

    var dataColors;
    colors=["#1abc9c","#4a81d4"];
    (dataColors=$("#sales-analytics").data("colors"))&&(colors=dataColors.split(","));
    var chart;
    options={
        series:[
            {
                name:"{{__('Current Month Visits')}}",
                type:"area",
                data:{!! json_encode($jml_visit) !!}
            },
            {
                name:"{{ __('Current Month Visitors') }}",
                type:"line",
                data:{!! json_encode($jml_visitor) !!}
            }
        ],
        chart:{
            height:378,
            type:"line"
        },
        stroke:{
            width:[2,3]
        },
        plotOptions:{
            bar:{
                columnWidth:"50%"
            }
        },
        colors:colors,
        dataLabels:{
            enabled:!0,
            enabledOnSeries:[1]
        },
        labels:{!! json_encode($label) !!},
        legend:{
            offsetY:7
        },
        grid:{
            padding:{
                bottom:20
            }
        },
        fill:{
            type:"gradient",
            gradient:{
                shade:"light",
                type:"horizontal",
                shadeIntensity:.25,
                gradientToColors:void 0,
                inverseColors:!0,
                opacityFrom:.75,
                opacityTo:.75,
                stops:[0,0,0]
            }
        },
        yaxis:[
            {
                title:{
                    text:"{{ __('Statistic') }}"
                }
            },
        ]
    };
    (chart=new ApexCharts(document.querySelector("#sales-analytics"),options)).render(),
    $("#dash-daterange").flatpickr({
        altInput:!0,
        mode:"range",
        altFormat:"F j, y",
        defaultDate:"today"
        }
    );
</script>
@endpush