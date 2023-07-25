@push('js-scripts')

<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
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

    var marker = L.marker(new L.LatLng(-3.0149811,120.1824745), {
        icon: L.mapbox.marker.icon({
            'marker-color': '#2F58CD',
            'marker-symbol': 'circle',
        }),
        draggable: true
    }).addTo(map).bindPopup('Geser untuk menentukan titik awal.').openPopup();

    marker.on('dragend', function(e) {
        document.getElementById('lat').value = marker.getLatLng().lat;
        document.getElementById('lon').value = marker.getLatLng().lng;
    });

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

    @isset($coordinates)
    @foreach ($coordinates as $item_coordinate)
    @if ($item_coordinate->type == 'coordinate')
    var marker2 = L.marker([{{ $item_coordinate->lat.','.$item_coordinate->lon }}], {
        icon: L.mapbox.marker.icon({
            'marker-size': 'large',
            'marker-symbol': '{{ $item_coordinate->icon_marker }}',
            'marker-color': '{{ $item_coordinate->color }}'
        })
    }).addTo(map);
    var content = "<div class='text-center'><h5>{{ $item_coordinate->name }}</h5></div> <hr> {{ $item_coordinate->description }}"
    marker2.bindPopup(content);
    @else
    
    L.mapbox.featureLayer("{{ asset('storage/geojson/'.$item_coordinate->geojson) }}").on('ready', function(e) {
        var clusterGroup = new L.MarkerClusterGroup({
        iconCreateFunction: function(cluster) {

            var mark = L.mapbox.marker.icon({
                    'marker-symbol': '{{ $item_coordinate->icon_marker }}',
                    'marker-color': '{{ $item_coordinate->color }}'
                })
            return mark;
            }
        });
        e.target.eachLayer(function(addLayer) {
            clusterGroup.addLayer(addLayer);
            
            var content = '<div><strong>' + addLayer.feature.properties.NAMOBJ + '</strong><br><small class="text-muted">'+ addLayer.feature.properties.REMARK +'</small></div>';
            addLayer.bindPopup(content);
        });
        map.addLayer(clusterGroup);
    });
    @endif
    @endforeach
    @endisset

</script>

<script>
    function showDiv(divCoord,divFile, element)
    {
        document.getElementById(divCoord).style.display = element.value == "coordinte" ? 'block' : 'none';
        document.getElementById(divFile).style.display = element.value == "file" ? 'block' : 'none';
    }
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