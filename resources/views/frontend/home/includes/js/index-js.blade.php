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

    @foreach ($regions as $region)       
    @foreach ($region->village as $village)       
    var {{ str_replace(" ","",$village->name) }};
    @endforeach
    @endforeach
    
    @isset($maps)
    @foreach ($maps as $map)
    $.getJSON("{{ asset('storage/public/geojson/'.$map->geojson) }}", function(data) {
        {{ str_replace(" ","",$map->village->name) }} = L.layerGroup().addTo(map);
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
        }).addTo({{ str_replace(" ","",$map->village->name) }});
        geoLayer.eachLayer(function(layer) {
            var properties = layer.feature.properties;
            var popupContent = `
            <div class="container pt-3">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th class="p-1">Provinsi</th>
                            <td class="p-1 text-lowercase">${properties.PROVINSI}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Kabupaten</th>
                            <td class="p-1 text-lowercase">${properties.KAB_KOTA}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Kecamatan</th>
                            <td class="p-1 text-lowercase">${properties.KECAMATAN}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Kelurahan/Desa</th>
                            <td class="p-1 text-lowercase">${properties.DESA_KELUR}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Penduduk</th>
                            <td class="p-1">${properties.JUMLAH_PEN}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah KK</th>
                            <td class="p-1">${properties.JUMLAH_KK}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Pria</th>
                            <td class="p-1">${properties.PRIA}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Perempuan</th>
                            <td class="p-1">${properties.WANITA}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Luas Wilayah</th>
                            <td class="p-1">${properties.LUAS_WILAY}</td>
                        </tr>
                        <tr>
                            <th class="p-1">Kepadatan</th>
                            <td class="p-1">${properties.KEPADATAN}</td>
                        </tr>
                    </thead>    
                </table>
            </div>
            `;

            layer.bindPopup(popupContent);
        });
    });

    @endforeach
    @endisset

    
    @foreach ($educations as $education)        
    var {{ str_replace(" ","",$education->name) }} = L.layerGroup().addTo(map); ;
    @endforeach

    @foreach ($coordinates as $item_coordinate)

    @if ($item_coordinate->type == 'coordinate')

    var popup = L.popup({
        className: 'custom-popup'
    }).setContent(`
        <div class="leaflet-popup-content">
            <div class="text-center">
                <img src="{{ asset('storage/public/img/'.$item_coordinate->image) }}" class="img-thumbnail w-100" loading="lazy">
            </div>
            <h5 class="text-center mt-2">{{ $item_coordinate->name }}</h5>
            <p class="mt-0">{{ $item_coordinate->description }}</p>
        </div>
    `);

    L.marker([{{ $item_coordinate->lat.','.$item_coordinate->lon }}], {
        icon: L.mapbox.marker.icon({
            'marker-size': 'large',
            'marker-symbol': '{{ $item_coordinate->icon_marker }}',
            'marker-color': '{{ $item_coordinate->color }}'
        })
    }).bindPopup(popup).addTo({{ str_replace(" ","",$item_coordinate->education->name) }});

    @else    
    L.mapbox.featureLayer("{{ asset('storage/public/geojson/'.$item_coordinate->geojson) }}").on('ready', function(e) {
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

    var overlytree =
    [
        {
            label: '<strong>Layer Wilayah</strong>',
            children: [
                @foreach ($regions as $region)  
                @if ($region->name == "Kecamatan Lamasi Timur")
                {   
                    label: '{{ $region->name }}',
                    selectAllCheckbox: 'Un/select all',
                    children: [
                        @foreach ($region->village as $village) 
                        {
                            label: '{{ $village->name }}',
                            layer: {{ str_replace(" ","",$village->name) }},
                            name:'{{ $village->name }}'
                        },
                        @endforeach
                    ]
                },
                @endif
                @endforeach
            ]
        },
        {
            label: '<strong>Layer Fasilitas</strong>',
            children: [{   
                label: 'Fasilitas Umum',
                selectAllCheckbox: 'Un/select all',
                children: [  
                    @foreach ($educations as $ed)
                    {
                        label: '{{ $ed->name }}',
                        layer: {{ str_replace(" ","",$ed->name) }}, 
                        name:'{{ $ed->name }}'
                    },                 
                    @endforeach
                ]
            }]
        }
    ];


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
    
    var layerControl = L.control.layers.tree(baseTree,overlytree);
    layerControl.addTo(map);
</script>
@endpush