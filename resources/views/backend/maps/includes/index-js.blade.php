@push('js-scripts')
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src="{{ asset('assets/leaflet/L.Control.Layers.Tree.js') }}"></script>
@push('page-scripts')
@endpush

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
        .setView([-2.492707, 120.759647], 12)
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
        }).addTo({{ $map->region->slug }});

        geoLayer.eachLayer(function(layer) {
            var properties = layer.feature.properties;
            var popupContent = `
            <div class="container pt-3">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th class="p-1">Desa</th>
                            <th class="p-1 text-lowercase">${properties.name}</th>
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

</script>
<script>
    $(document).ready(function(){
        $('#table-maps').DataTable({
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
                url: '{{ route("app.maps.load-data") }}',
                cache:false,
            },
            columns: [
                { "data":null,"sortable": false, className:'text-center',render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                } },
                { data: 'region', name: 'region' },
                { data: 'village', name: 'village' },
                { data: 'color', name: 'color', className:'text-center' },
                { data: 'created_at', name: 'created_at', className:'text-center' },
                { data: 'id', name: 'id', className:'text-center', render:function(data){
                    return '<div class="btn-group">'+
                                '<a href="/app/map-list/'+data+'/edit" class="btn btn-sm btn-warning"><i class="fe-edit"></i></a>'+
                                '<button type="button" class="btn btn-sm btn-danger hapus-data" data-id="'+data+'"><i class="fe-trash"></i></button>'+
                            '</div>';
                } },
            ],          
            search: {
                "regex": true
            },
        });

        
        $("#table-maps").on('click','.hapus-data[data-id]',function(e){
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
                        url: "{{ route('app.maps.delete') }}",
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
                                $('#table-maps').DataTable().ajax.reload();
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