<x-app-layout>
    
        
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}" async defer></script>
    <style>
        #map {
            height: 700px !important;
            width: 100%;
        }
    </style>
    
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kemaskini Lokasi Geran') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.update_location') }}" id="editlocationForm">
                        @csrf

                        <!-- Lot and Tempat in a single row -->
                        <div class="mt-2 flex w-full">
                            <!-- Lot -->
                            <div class="flex-1 pr-2">
                                <x-input-label for="lot" :value="__('Lot')" />
                                <input type="text" name="lot" id="lot" class="block mt-1 w-full" value="{{ @$location->lot }}" required autofocus>
                                <x-input-error :messages="$errors->get('lot')" class="mt-2" />
                                <input type="text" name="latitude" value="{{ @$location->latitude_map }}" class="mt-1 w-full" id="latitude" placeholder="Latitude" hidden>
                                <input type="text" name="id" value="{{ $location->id }}" hidden>
                            </div>

                            <!-- Spacer -->
                            <div class="w-4"></div> <!-- Adjust width as needed -->

                            <!-- Tempat -->
                            <div class="flex-1 pl-2">
                                <x-input-label for="area" :value="__('Tempat')" />
                                <input type="text" name="area" id="area" class="block mt-1 w-full" value="{{ $location->area }}" required autofocus>
                                <x-input-error :messages="$errors->get('area')" class="mt-2" />
                                <input type="text" name="longitude" value="{{ @$location->longitude_map }}" class="mt-1 w-full" id="longitude" placeholder="Longitude" hidden>
                            </div>
                        </div>
                        
                        <!-- Negeri -->
                        <div class="mt-2">
                            <x-input-label for="state" :value="__('Negeri')" />
                            <select id="state" name="state" class="block mt-1 w-full rounded-md border-gray-300" required autofocus disabled>
                                <option value="">-- Pilih Negeri --</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ $location->state_id == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                        
                        <!-- Daearah -->
                        <div class="mt-2">
                            <x-input-label for="district" :value="__('Daerah')" />
                            <select id="district" name="district" class="block mt-1 w-full rounded-md border-gray-300" required autofocus disabled>
                                <option value="">-- Pilih Daerah --</option>
                            </select>
                            <x-input-error :messages="$errors->get('district')" class="mt-2" />
                        </div>
                        
                        <!-- Mukim -->
                        <div class="mt-2">
                            <x-input-label for="city" :value="__('Bandar/Pekan/Mukim')" />
                            <select id="city" name="city" class="block mt-1 w-full rounded-md border-gray-300" required autofocus disabled>
                                <option value="">-- Pilih Bandar/Pekan/Mukim --</option>
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        
                        <!-- Nota -->
                        <div class="mt-2" id="notes_section">
                            <label for="notes">Nota / Komen</label>
                            <textarea name="notes" id="notes" cols="10" rows="5" class="block mt-1 w-full rounded-md border-gray-300" placeholder="Nota...">{{ @$location->notes }}</textarea>
                        </div>

                        <div class="flex items-center justify-center mt-4" id="option_button">
                            <button type="button" class="ms-3 cari_location text-white py-2 px-4 rounded-md" id="kemaskini_location_button" style="background-color:#374151 !important; font-weight:bold !important;">
                                Kemaskini
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div id="map" style="height:700px !important; width:100%;"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>

        let map, marker;

        $(document).ready(function(){

            function initMap(lot, area, city, district, state, region, latitude, longitude, nota) {
                let defaultLocation;

                defaultLocation = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

                // If coordinates are provided, initialize the map immediately
                initializeMap(defaultLocation);
            }
            
            // Helper function to initialize the map
            function initializeMap(location) {
                // Initialize the map
                map = new google.maps.Map(document.getElementById('map'), {
                    zoom: 18,
                    center: location,
                    mapTypeId: 'satellite',
                });

                // Add a marker at the location
                marker = new google.maps.Marker({
                    position: location,
                    map: map,
                    title: 'Land Location'
                });

                // Add a double-click event listener to the map
                map.addListener('dblclick', (event) => {
                    // Update the marker's position to the clicked location
                    marker.setPosition(event.latLng);
                    
                    // Update the latitude and longitude input fields
                    document.getElementById('latitude').value = event.latLng.lat();
                    document.getElementById('longitude').value = event.latLng.lng();
                });

            }

            var old_district_id = "{{ old('district', @$location->district_id) }}";

            var old_city_id = "{{ old('city', @$location->city_id) }}";

            // console.log('old district '+old_district_id);

            // console.log('old city '+old_city_id);

            getDistrict();

            function getDistrict(){

                var state_id = $('#state').find('option:selected').val();

                // console.log('negeri '+state_id);

                $.ajax({
                    type: "get",
                    url: "/get_district_list",
                    data: {
                        state_id : state_id
                    },
                    success: function(response) {
                        // console.log('data' +response.data);

                        $('#district').empty();
                        $('#district').append('<option value="">-- Pilih Daerah --</option>')
                        $.each(response.data, function(key, value) {
                            var isSelected = value.id == old_district_id ? 'selected' : '';
                            var optionElement = '<option value="' + value.id + '" '+isSelected+'>' + value.name + '</option>';
                            $('#district').append(optionElement);

                            if(isSelected == 'selected'){
                                $('#district').change();
                            }
                        });


                    },
                    error: function(response) {
                        alert(response);
                    }
                });

            }

            function getCity(){

                var district_id = $('#district').find('option:selected').val();

                // console.log('daerah '+district_id);

                $.ajax({
                    type: "get",
                    url: "/get_city_list",
                    data: {
                        district_id : district_id
                    },
                    success: function(response) {
                        // console.log('data' +response.data);

                        $('#city').empty();
                        $('#city').append('<option value="">-- Pilih Bandar/Pekan/Mukim --</option>')
                        $.each(response.data, function(key, value) {
                            var isSelected = value.id == old_city_id ? 'selected' : '';
                            var optionElement = '<option value="' + value.id + '" '+isSelected+'>' + value.name + '</option>';
                            $('#city').append(optionElement);

                            if(isSelected == 'selected'){
                                $('#city').change();
                            }

                            initMap('{{ @$location->lot }}', '{{ @$location->area }}', '{{ @$location->city->name }}', '{{ @$location->district->name }}', '{{ @$location->state->name }}', 'MY', '{{ @$location->latitude_map }}', '{{ @$location->longitude_map }}', '{{ @$location->notes }}');

                        });


                    },
                    error: function(response) {
                        alert(response);
                    }
                });

            }

            $(document).on('change', '#state', function(){
                // console.log('test 1');
                getDistrict();
            });

            $(document).on('change', '#district', function(){
                // console.log('test 2');
                getCity();
            });

        });

        // Use event delegation for dynamically created buttons
        $(document).on('click', '#kemaskini_location_button', function() {
            Swal.fire({
                title: 'Anda pasti?',
                text: "Anda pasti semua data dan pin lokasi adalah betul?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pasti!',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#state').attr('disabled', false);
                    $('#district').attr('disabled', false);
                    $('#city').attr('disabled', false);
                    $('#editlocationForm').submit();
                }
            });
        });
        
    </script>

</x-app-layout>
