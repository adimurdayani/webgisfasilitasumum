@push('page-scripts-front')
<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
        .setView([-2.876258, 120.292130], 13)
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
    L.control.scale().addTo(map);
    map.scrollWheelZoom.disable();
    @foreach ($regions as $region)       
    @foreach ($region->village as $village)       
    var {{ str_replace(" ","",$village->name) }};
    @endforeach
    @endforeach

    @isset($maps)
    @foreach ($maps as $map)
    {{ str_replace(" ","",$map->village->name) }} = L.layerGroup().addTo(map);
    $.getJSON("{{ asset('storage/public/geojson/'.$map->geojson) }}", function(data) {
        var geoLayer = L.geoJson(data, {
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
                            <th class="p-1">${properties.PROVINSI}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Kabupaten</th>
                            <th class="p-1">${properties.KAB_KOTA}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Kecamatan</th>
                            <th class="p-1">${properties.KECAMATAN}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Kelurahan/Desa</th>
                            <th class="p-1">${properties.DESA_KELUR}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Penduduk</th>
                            <th class="p-1">${properties.JUMLAH_PEN}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah KK</th>
                            <th class="p-1">${properties.JUMLAH_KK}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Pria</th>
                            <th class="p-1">${properties.PRIA}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Jumlah Perempuan</th>
                            <th class="p-1">${properties.WANITA}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Luas Wilayah</th>
                            <th class="p-1">${properties.LUAS_WILAY}</th>
                        </tr>
                        <tr>
                            <th class="p-1">Kepadatan</th>
                            <th class="p-1">${properties.KEPADATAN}</th>
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
    var {{ str_replace(" ","",$education->name) }} = L.layerGroup().addTo(map);
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

    var baseTree = [
        {
            label: '<strong>Layer Maps</strong>',
            children: [
                    {
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
                }
            ]
        }
    ];  
    
    var layerControl = L.control.layers.tree(baseTree,{
                collapsed: false,
            });
    layerControl.addTo(map).collapseTree().expandSelected();

    var wilayah = [
        {
            label: '<strong>Layer Wilayah</strong>',
            children: [
                @foreach ($regions as $region)  
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
            
    layerControl.setOverlayTree(wilayah).collapseTree(true).expandSelected(false);
</script>
@endpush