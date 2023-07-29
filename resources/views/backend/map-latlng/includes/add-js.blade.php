@push('js-scripts')

<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-markercluster/v1.0.0/leaflet.markercluster.js'></script>
<script src="{{ asset('assets/') }}/libs/flatpickr/flatpickr.min.js"></script>
<script src="{{ asset('assets/') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-size.js">
</script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-file-validate-type.js">
</script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-image-preview.js"></script>
<script src="{{ asset('assets') }}/filepond/filepond-plugin-image-transform.js"></script>

<script src="{{ asset('assets') }}/filepond/filepond.js"></script>
@endpush

@push('page-scripts')

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
    .setView([-2.83220731175784,120.19631465218663],11)
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

    var marker = L.marker(new L.LatLng(-2.83220731175784,120.19631465218663), {
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

    var popup = L.popup({
        className: 'custom-popup'
    })
    .setContent(`
        <div class="leaflet-popup-content">
            <div class="text-center">
                <img src="{{ asset('storage/public/img/'.$item_coordinate->image) }}" class="img-thumbnail w-100" loading="lazy">
            </div>
            <h5 class="text-center mt-2">{{ $item_coordinate->name }}</h5>
            <p class="mt-0">{{ $item_coordinate->description }}</p>
        </div>
    `);

    var marker2 = L.marker([{{ $item_coordinate->lat.','.$item_coordinate->lon }}], {
        icon: L.mapbox.marker.icon({
            'marker-size': 'small',
            'marker-symbol': '{{ $item_coordinate->icon_marker }}',
            'marker-color': '{{ $item_coordinate->color }}'
        })
    }).addTo(map);

    marker2.bindPopup(popup);

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
            var content = '<div><strong>' + properties.REMARK + '</strong><br><small class="text-muted">'+ properties.NAMOBJ +'</small></div>';
                layer.bindPopup(content);
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
        document.getElementById(divCoord).style.display = element.value == "coordinate" ? 'block' : 'none';
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

        $('select[name="region_id"]').on('change',function(){
            var id = $(this).val();
            $.ajax({
                url: "/app/map-list/"+id+"/village",
                type: 'GET',
                dataType: "JSON",
                success: function (response){
                    var villageSelect = $('select[name="village_id"]');
                    villageSelect.empty();
                    response.forEach(function(data){
                        villageSelect.append('<option value="'+data.id+'">'+data.name+'</option>');
                    })
                },
                error: function(error){
                    var villageSelect = $('select[name="village_id"]');
                    villageSelect.empty();
                }
            });
        })

        FilePond.registerPlugin(FilePondPluginFileValidateSize);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginImageTransform);

        FilePond.create(document.querySelector('input[name="image"]'), {
            allowFileSizeValidation:true,
            maxFileSize:1000000,
            imageValidateSizeMaxWidth:600000,
            acceptedFileTypes: ['image/png','image/jpg','image/jpeg'],      
            imageResizeTargetWidth: 600,
            imageCropAspectRatio: 1,
            imageTransformVariants: {
                thumb_medium_: (transforms) => {
                    transforms.resize = {
                        size: {
                            width: 960,
                            height: 600,
                        },
                    };
                    return transforms;
                }
            },
            fileValidateTypeDetectType: (source, type) =>
            new Promise((resolve, reject) => {
                resolve(type);
            }),
        }).setOptions({
            server:{
                process: '{{ route("app.coordinates.tmpupload-img") }}',
                revert: '{{ route("app.coordinates.tmpdelete") }}',
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                }
            }
        });
    });
</script>

@endpush