@push('js-scripts')
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src="{{ asset('assets/leaflet/L.Control.Layers.Tree.js') }}"></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
@endpush

@push('page-scripts')
<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
        .setView([-2.3951133461259433, 120.59756598110653], 13)
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
                            <th class="p-1">${properties.name}</th>
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
        e.target.eachLayer(function(layer) {  
            clusterGroup.addLayer(layer);
            var properties = layer.feature.properties;            
            var content = '<div><strong>' + properties.name + '</strong></div>';
                layer.bindPopup(content);
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
            
    
    var layerControl = L.control.layers.tree(baseTree,wilayah,{
                collapsed: true,
            });
    layerControl.addTo(map).collapseTree(true).expandSelected();
</script>
<script>
    $(document).ready(function(){
        $('#table-coordinate').DataTable({
            language:
            {
                paginate:
                {
                    previous:"<i class='mdi mdi-chevron-left'>",
                    next:"<i class='mdi mdi-chevron-right'>"
                },
                processing: '<div class="spinner-border text-success m-2" role="status"></div>'
            },
            drawCallback:function(){
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            "aLengthMenu": [
                [5,10, 25, 50, 100, 200, -1],
                [5,10, 25, 50, 100, 200, "All"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("app.coordinates.load-data") }}',
                cache:false,
            },
            columns: [
                { "data":null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'region', name: 'region' },
                { data: 'education', name: 'education' },
                { data: 'name', name: 'name'},
                { data: 'description', name: 'description'},
                { data: 'color', name: 'color', className:'text-center'},
                { data: 'icon_marker', name: 'icon_marker', className:'text-center' },
                { data: 'created_at', name: 'created_at', className:'text-center' },
                { data: 'id', name: 'id', className:'text-center', render:function(data){
                    return '<div class="btn-group">'+
                                '<a href="/app/coordinate/'+data+'/edit" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+data+'"><i class="fe-trash"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        $('#table-file-coordinate').DataTable({
            language:
            {
                paginate:
                {
                    previous:"<i class='mdi mdi-chevron-left'>",
                    next:"<i class='mdi mdi-chevron-right'>"
                },
                processing: '<div class="spinner-border text-success m-2" role="status"></div>'
            },
            drawCallback:function(){
                $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
            },
            "aLengthMenu": [
                [5,10, 25, 50, 100, 200, -1],
                [5,10, 25, 50, 100, 200, "All"]
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route("app.coordinates.load-file") }}',
                cache:false,
            },
            columns: [
                { "data":null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'name', name: 'name'},
                { data: 'description', name: 'description'},
                { data: 'color', name: 'color', className:'text-center'},
                { data: 'icon_marker', name: 'icon_marker', className:'text-center' },
                { data: 'geojson', name: 'geojson', className:'text-center' },
                { data: 'created_at', name: 'created_at', className:'text-center' },
                { data: 'id.type', name: 'id.type', className:'text-center', render:function(data,row,value){
                    return '<div class="btn-group">'+
                                '<a href="/app/coordinate/'+value.id+'/edit/type" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+value.id+'"><i class="fe-trash"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        
        $("#table-coordinate").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();

            var id = $(this).data("id");
            Swal.fire({
                title:"Apakah anda yakin?",
                text:"Anda akan menghapus data tersebut secara permanen!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Yes, delete it!",
                cancelButtonText:"No, cancel!",
                confirmButtonClass:"btn btn-sm btn-success mt-2",                    
                cancelButtonClass:"btn btn-sm btn-danger ml-2 mt-2",
                buttonsStyling:!1
            }).then((result)=>{
                if (result.value) {
                    $.ajax({
                        url: "{{ route('app.coordinates.delete') }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        data: {
                            "id": id,
                        },
                        dataType: "JSON",
                        success: function (response){
                            if (response.success) {
                                $('#table-coordinate').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    timer:700
                                });
                            }else{
                                Swal.fire({
                                    title:"Gagal!",
                                    text:response.error,
                                    type:"error",
                                    timer:700
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });

        $("#table-file-coordinate").on('click','.hapus-data[data-id]',function(e){
            e.preventDefault();

            var id = $(this).data("id");
            Swal.fire({
                title:"Apakah anda yakin?",
                text:"Anda akan menghapus data tersebut secara permanen!",
                type:"warning",
                showCancelButton:!0,
                confirmButtonText:"Yes, delete it!",
                cancelButtonText:"No, cancel!",
                confirmButtonClass:"btn btn-sm btn-success mt-2",                    
                cancelButtonClass:"btn btn-sm btn-danger ml-2 mt-2",
                buttonsStyling:!1
            }).then((result)=>{
                if (result.value) {
                    $.ajax({
                        url: "{{ route('app.coordinates.delete') }}",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{csrf_token()}}'
                        },
                        data: {
                            "id": id,
                        },
                        dataType: "JSON",
                        success: function (response){
                            if (response.success) {
                                $('#table-file-coordinate').DataTable().ajax.reload();
                                Swal.fire({
                                    title:"Sukses!",
                                    text:response.success,
                                    type:"success",
                                    timer:700
                                });
                            }else{
                                Swal.fire({
                                    title:"Gagal!",
                                    text:response.error,
                                    type:"error",
                                    timer:700
                                });
                            }
                        }
                    });
                }else if (result.dismiss === swal.DismissReason.cancel) {}

            })
        });

        
        @if(Session::has('error'))
            Swal.fire({
                title:"Error!",
                text:"{{ session('error') }}",
                type:"error",
                timer:700
            })
        @endif
    });
</script>

@endpush