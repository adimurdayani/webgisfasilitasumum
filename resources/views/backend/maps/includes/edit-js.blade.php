@push('js-scripts')

<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
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

</script>
<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif
        $('[data-toggle="select2"]').select2()
    });
</script>

@endpush