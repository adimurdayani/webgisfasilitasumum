@push('js-scripts')

<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src="{{ asset('assets/') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
<script src="{{ asset('assets/') }}/libs/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('assets/') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
@endpush

@push('page-scripts')

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
    .setView([-3.0149811,120.1824745],11)
    .addControl(L.mapbox.geocoderControl('mapbox.places', {
      autocomplete: true
    }));
    L.control.layers({
        'Mapbox Streets': L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11').addTo(map),
        'Mapbox Light': L.mapbox.styleLayer('mapbox://styles/mapbox/light-v10'),
        'Mapbox Outdoors': L.mapbox.styleLayer('mapbox://styles/mapbox/outdoors-v11'),
        'Mapbox Satellite': L.mapbox.styleLayer('mapbox://styles/mapbox/satellite-v9')
    }).addTo(map);

    L.control.fullscreen().addTo(map);
    L.control.locate().addTo(map);
    L.control.scale().addTo(map);

    @isset($maps)
    @foreach ($maps as $map)
    $.getJSON("{{ asset('storage/geojson/'.$map->geojson) }}", function(data) {
        var geoLayer = L.geoJson(data, {
            style: function(feature) {
                return {
                    opacity: 0.6,
                    color: '{{ $map->color }}',
                    fillOpacity: 0.6,
                    fillColor: '{{ $map->color }}'
                }
            }
        }).addTo(map);

        geoLayer.eachLayer(function(layer) {
            layer.bindPopup("{{ $map->region->name }}");
        });
    });
    @endforeach
    @endisset
 
    L.mapbox.featureLayer("{{ asset('storage/geojson/'.$coordinate->geojson) }}").on('ready', function(e) {
        var clusterGroup = new L.MarkerClusterGroup({
        iconCreateFunction: function(cluster) {

            var mark = L.mapbox.marker.icon({
                    'marker-symbol': '{{ $coordinate->icon_marker }}',
                    'marker-color': '{{ $coordinate->color }}'
                })
            return mark;
            }
        });
        e.target.eachLayer(function(addLayer) {  
            console.log(addLayer.feature.properties);   
            clusterGroup.addLayer(addLayer);
            
            var content = '<div><strong>' + addLayer.feature.properties.NAMOBJ + '</strong><br><small class="text-muted">'+ addLayer.feature.properties.REMARK +'</small></div>';
            addLayer.bindPopup(content);
        });
        map.addLayer(clusterGroup);
    });

</script>
<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        @if(Session::has('success'))
            Swal.fire({
                title:"Success!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif

        @if(Session::has('error'))
            Swal.fire({
                title:"Erorr!",
                text:"{{ session('error') }}",
                type:"error",
                timer:1000
            })
        @endif

        $('[data-toggle="select2"]').select2()
        $(".horizontal-colorpicker").colorpicker({horizontal:!0})
    });
</script>

@endpush