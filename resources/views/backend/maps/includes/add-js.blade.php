@push('js-scripts')
<script src="{{ asset('assets/') }}/libs/select2/js/select2.min.js"></script>
<script src="{{ asset('assets/') }}/libs/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>

<script src='https://api.mapbox.com/mapbox.js/v3.3.1/mapbox.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-locatecontrol/v0.43.0/L.Control.Locate.min.js'></script>
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
@endpush

@push('page-scripts')

<script>
    L.mapbox.accessToken = 'pk.eyJ1IjoiYWRpbXVyZGF5YW5pIiwiYSI6ImNrcmdyNG9oazBrOTIydnFuc21kYW53YjIifQ.kKTX_r3f99B-LTG5XKmUHA';
    var map = L.mapbox.map('map')
    .setView([-2.3951133461259433, 120.59756598110653],11)
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
    L.control.scale().addTo(map);

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
            var properties = layer.feature.properties;
            var popupContent = `
            <div class="container pt-3">
                <table class="table table-bordered w-100">
                    <thead>
                        <tr>
                            <th class="p-1">Desa</th>
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

</script>
<script>
    $(document).ready(function(){
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

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
        
        @if(Session::has('success'))
            Swal.fire({
                title:"Sukses!",
                text:"{{ session('success') }}",
                type:"success",
                timer:700
            })
        @endif
        $('[data-toggle="select2"]').select2()
        $(".horizontal-colorpicker").colorpicker({horizontal:!0})
    });
</script>

@endpush