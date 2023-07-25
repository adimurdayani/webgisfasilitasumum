@push('page-scripts-front')
<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
        .setView([-2.810067, 120.170247], 11)
        .addControl(L.mapbox.geocoderControl('mapbox.places',{
            autocomplete: true 
        }));

    var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // Google Map Layer
    var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleStreets.addTo(map);

    // Satelite Layer
    var googleSat = L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
        maxZoom: 19,
        subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
    });
    googleSat.addTo(map);

    L.control.fullscreen().addTo(map);
    L.control.locate().addTo(map);
    L.control.scale().addTo(map);
    map.scrollWheelZoom.disable();

    @isset($maps)
    @foreach ($maps as $map)
    var {{ $map->region->slug }} = L.layerGroup().addTo(map);
    $.getJSON("{{ asset('storage/geojson/'.$map->geojson) }}", function(data) {
        var geoLayer = L.geoJson(data, {
            
            pointToLayer: function(feature,latlng){
                return L.marker(latlng);
            },
            onEachFeature:  function(feature, layer) {
                layer.bindPopup(feature.properties.name);
            },
            style: function(feature) {
                return {
                    opacity: 0.6,
                    color: '{{ $map->color }}',
                    fillOpacity: 0.6,
                    fillColor: '{{ $map->color }}'
                }
            }
        }).addTo({{ $map->region->slug }});
        geoLayer.eachLayer(function(layer) {
            layer.bindPopup("<center><strong>{{ $map->region->name }}</strong></center>"
            +"<table class='w-100 table table-bordered'>"
                +"<tr>"
                    +"<td colspan='2'>Jumlah Penduduk</td>"
                +"</tr>"
                +"<tr>"
                    +"<td class='p-0'>Laki-Laki</td>"
                    +"<td class='p-0'>{{ number_format($map->man,0) }}</td>"
                +"</tr>"
                +"<tr>"
                    +"<td class='p-0'>Perempuan</td>"
                    +"<td class='p-0'>{{ number_format($map->woman,0) }}</td>"
                +"</tr>"
            +"</table>");
        });
    });

    @endforeach
    @endisset

    @isset($coordinates)
    @foreach ($coordinates as $item_coordinate)
    @if ($item_coordinate->type == 'coordinate')
    var {{ $item_coordinate->education->name }} = L.layerGroup().addTo(map);

    var marker2 = L.marker([{{ $item_coordinate->lat.','.$item_coordinate->lon }}], {
        icon: L.mapbox.marker.icon({
            'marker-size': 'large',
            'marker-symbol': '{{ $item_coordinate->icon_marker }}',
            'marker-color': '{{ $item_coordinate->color }}'
        })
    }).addTo({{ $item_coordinate->education->name }});
    var content = "<div class='text-center'><strong>{{ $item_coordinate->name }}</strong></div> <hr> {{ $item_coordinate->description }}"
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
            if (addLayer.feature.properties.NAMOBJ) {
                var content = '<div><strong>' + addLayer.feature.properties.NAMOBJ + '</strong><br><small class="text-muted">'+ addLayer.feature.properties.REMARK +'</small></div>';
                addLayer.bindPopup(content);
            }else{
                var content2 = '<div><strong>' + addLayer.feature.properties.Name + '</strong><br></small></div>';
                addLayer.bindPopup(content2);
            }
        });
        map.addLayer(clusterGroup);
    });


    @endif

    @endforeach
    @endisset


    var baseTree = [{
        label: '<strong>Layer Maps</strong>',
        children: [{
            label: 'Maps',
            children: [{
                label: 'OpenStreetMap',
                layer: osm
            }, {
                label: 'Google Map',
                layer: googleStreets
            }, {
                label: 'Satellite',
                layer: googleSat
            }]
        }]
    }];
    var overlytree =
    [{
        label: '<strong>Kecamatan</strong>',
        children: [
            @foreach ($regions as $region)  
            {
                label: '{{ $region->name }}',
                layer: {{ $region->slug }}
            },
            @endforeach
        ],
    }];
    
    var layerControl = L.control.layers.tree(baseTree,overlytree);
    layerControl.addTo(map);
</script>
@endpush