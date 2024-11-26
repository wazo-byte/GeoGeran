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
            {{ __('Carian Lokasi Geran') }}
        </h2>
    </x-slot>

    <div class="py-2">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('user.search_location') }}" id="locationForm">
                        @csrf

                        <!-- Lot and Tempat in a single row -->
                        <div class="mt-2 flex w-full">
                            <!-- Lot -->
                            <div class="flex-1 pr-2">
                                <x-input-label for="lot" :value="__('Lot')" />
                                <x-text-input id="lot" class="block mt-1 w-full" type="text" name="lot" :value="old('lot')" required autofocus />
                                <x-input-error :messages="$errors->get('lot')" class="mt-2" />
                                <input type="text" name="latitude" value="" class="mt-1 w-full" id="latitude" placeholder="Latitude" hidden>
                            </div>

                            <!-- Spacer -->
                            <div class="w-4"></div> <!-- Adjust width as needed -->

                            <!-- Tempat -->
                            <div class="flex-1 pl-2">
                                <x-input-label for="area" :value="__('Tempat')" />
                                <x-text-input id="area" class="block mt-1 w-full" type="text" name="area" :value="old('area')" required autofocus />
                                <x-input-error :messages="$errors->get('area')" class="mt-2" />
                                <input type="text" name="longitude" value="" class="mt-1 w-full" id="longitude" placeholder="Longitude" hidden>
                            </div>
                        </div>
                        
                        <!-- Negeri -->
                        <div class="mt-2">
                            <x-input-label for="state" :value="__('Negeri')" />
                            <select id="state" name="state" class="block mt-1 w-full rounded-md border-gray-300" required autofocus>
                                <option value="">-- Pilih Negeri --</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}" {{ old('state') == $state->id ? 'selected' : '' }}>{{ $state->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                        </div>
                        
                        <!-- Daearah -->
                        <div class="mt-2">
                            <x-input-label for="district" :value="__('Daerah')" />
                            <select id="district" name="district" class="block mt-1 w-full rounded-md border-gray-300" required autofocus>
                                <option value="">-- Pilih Daerah --</option>
                            </select>
                            <x-input-error :messages="$errors->get('district')" class="mt-2" />
                        </div>
                        
                        <!-- Mukim -->
                        <div class="mt-2">
                            <x-input-label for="city" :value="__('Bandar/Pekan/Mukim')" />
                            <select id="city" name="city" class="block mt-1 w-full rounded-md border-gray-300" required autofocus>
                                <option value="">-- Pilih Bandar/Pekan/Mukim --</option>
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />
                        </div>
                        
                        <!-- Nota -->
                        <div class="mt-2" id="notes_section">
                        </div>

                        <div class="flex items-center justify-center mt-4" id="option_button">
                            <button type="button" class="ms-3 cari_location text-white py-2 px-4 rounded-md" id="cari_location_button" style="background-color:#374151 !important; font-weight:bold !important;">
                                Cari
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
        

        $(document).on('click', '#cari_location_button', function(event) {
            event.preventDefault(); // Prevent the default form submission

            // Extract values from the form
            const lot = document.getElementById('lot').value;
            const area = document.getElementById('area').value;

            // Get the selected option text
            const stateSelect = document.getElementById('state');
            const state_id = document.getElementById('state').value;
            const state = stateSelect.options[stateSelect.selectedIndex].text;

            const districtSelect = document.getElementById('district');
            const district_id = document.getElementById('district').value;
            const district = districtSelect.options[districtSelect.selectedIndex].text;

            const citySelect = document.getElementById('city');
            const city_id = document.getElementById('city').value;
            const city = citySelect.options[citySelect.selectedIndex].text;

            const region = 'MY'; // Assuming the region is Malaysia
            
            $.ajax({
                type: 'POST',
                url: $('#locationForm').attr('action'),
                data: $('#locationForm').serialize(),
                success: function(response) {
                    console.log(response);

                    if(response.status == 'success'){

                        // toastr.success(response.Message, 'Berjaya');

                        const status = 'search_by_latitude_longitude';
                        // Call the initMap function with the gathered values
                        initMap(lot, area, city, district, state, region, status, response.data.latitude, response.data.longitude, response.data.notes);

                    }
                    else{

                        const status = 'search_by_address';
                        // toastr.warning(response.Message, 'Maaf');

                        // Call the initMap function with the gathered values
                        initMap(lot, area, city, district, state, region, status, '', '', '');

                        $('#option_button').empty();

                        var app = '';

                        app += '<button type="button" class="ms-3 simpan_location text-white py-2 px-4 rounded-md" id="simpan_location_button" style="background-color:#1bdf00 !important; font-weight:bold !important;">';
                        app +=        'Simpan';
                        app += '</button>';

                        $('#option_button').append(app);

                    }


                },
                error: function(xhr) {
                    console.log(xhr.responseJSON);
                    if (xhr.responseJSON && xhr.responseJSON.errors) {
                        let errors = xhr.responseJSON.errors;
                        for (let field in errors) {
                            toastr.error(errors[field].join(' '), 'Validation Error');
                        }
                    } else {
                        toastr.error('There was an error submitting the form.', 'Error');
                    }
                }
            });

        });

        function initMap(lot, area, city, district, state, region, status, latitude, longitude, nota) {
            let defaultLocation;

            // Check if latitude and longitude are provided
            if (latitude && longitude) {
                // Use the provided coordinates
                defaultLocation = { lat: parseFloat(latitude), lng: parseFloat(longitude) };
            } else {
                // Construct the full address
                const fullAddress = `${lot}+${area},+${city},+${district},+${state},+${region}`;

                // Build the API URL
                const apiKey = '{{ env('GOOGLE_MAPS_API_KEY') }}'; // Ensure you have the API key in .env
                const geocodeUrl = `https://maps.googleapis.com/maps/api/geocode/json?address=${encodeURIComponent(fullAddress)}&key=${apiKey}`;

                console.log('geo code ' + geocodeUrl);

                // Fetch geolocation
                fetch(geocodeUrl)
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'OK') {
                            const location = data.results[0].geometry.location;
                            defaultLocation = { lat: location.lat, lng: location.lng };

                            // Set the latitude and longitude to the input fields
                            document.getElementById('latitude').value = defaultLocation.lat;
                            document.getElementById('longitude').value = defaultLocation.lng;

                            // Initialize the map
                            initializeMap(defaultLocation);

                            // Display a success message based on status
                            if (status === 'default') {

                                toastr.success(`Lokasi Asal : ${data.results[0].formatted_address}`);
                            }
                            else if(status === 'search_by_latitude_longitude'){

                                $('#notes_section').empty();

                                var notes = '';

                                notes += '<label for="notes">Nota / Komen</label>';
                                notes += '<textarea name="notes" id="notes" cols="10" rows="5" class="block mt-1 w-full rounded-md border-gray-300" placeholder="Nota...">'+nota+'</textarea>';

                                $('#notes_section').append(notes);

                                toastr.success(`Carian lokasi dijumpai dalam pangkalan data GeoGeran : `+lot+', '+area+', '+city+', '+district+', '+state+', '+region);

                            }
                            else {

                                $('#notes_section').empty();

                                var notes = '';

                                notes += '<label for="notes">Nota</label>';
                                notes += '<textarea name="notes" id="notes" cols="10" rows="5" class="block mt-1 w-full rounded-md border-gray-300" placeholder="Nota..."></textarea>';

                                $('#notes_section').append(notes);

                                toastr.warning(`Lokasi tidak dijumpai dalam pangkalan data GeoGeran : ${data.results[0].formatted_address}`);
                                toastr.warning(`Anda boleh menyimpan data ini dalam pangkalan data GeoGeran. Terima Kasih.`);

                            }

                        } else {
                            alert('Geocoding failed: ' + data.status);
                        }
                    })
                    .catch(error => console.error('Error fetching geolocation:', error));

                return; // Exit the function since we are waiting for geocoding results
            }

            // If coordinates are provided, initialize the map immediately
            initializeMap(defaultLocation);


            // Display a success message based on status
            if (status == 'default') {

                toastr.success(`Lokasi Asal : ${data.results[0].formatted_address}`);
            }
            else if(status == 'search_by_latitude_longitude'){

                $('#notes_section').empty();

                var notes = '';

                notes += '<label for="notes">Nota / Komen</label>';
                notes += '<textarea name="notes" id="notes" cols="10" rows="5" class="block mt-1 w-full rounded-md border-gray-300" placeholder="Nota...">'+nota+'</textarea>';

                $('#notes_section').append(notes);

                toastr.success(`Carian lokasi dijumpai dalam pangkalan data GeoGeran : `+lot+', '+area+', '+city+', '+district+', '+state+', '+region);

            }
            else {

                $('#notes_section').empty();

                var notes = '';

                notes += '<label for="notes">Nota</label>';
                notes += '<textarea name="notes" id="notes" cols="10" rows="5" class="block mt-1 w-full rounded-md border-gray-300" placeholder="Nota..."></textarea>';

                $('#notes_section').append(notes);

                toastr.success(`Lokasi tidak dijumpai dalam pangkalan data GeoGeran : ${data.results[0].formatted_address}`);
                toastr.warning(`Anda boleh menyimpan data ini dalam pangkalan data GeoGeran. Terima Kasih.`);

            }
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

        // Initialize the map on page load (with a default location or as needed)
        window.onload = () => {
            initMap('', '', '', '', 'Kuala Lumpur', 'MY', 'default', '', '', ''); // You may want to set a default location or use previous values
        };

        $(document).on('keyup change', '#state', function(){

            var state_id = $(this).val();

            console.log('negeri '+state_id);

            $.ajax({
                type: "get",
                url: "/get_district_list",
                data: {
                    state_id : state_id
                },
                success: function(response) {
                    console.log('data' +response.data);

                    $('#district').empty();
                    $('#district').append('<option value="">-- Pilih Daerah --</option>')
                    $.each(response.data, function(key, value) {
                        var optionElement = '<option value="' + value.id + '">' + value.name + '</option>';
                        $('#district').append(optionElement);
                    });


                },
                error: function(response) {
                    alert(response);
                }
            });

        });

        $(document).on('keyup change', '#district', function(){

            var district_id = $(this).val();

            console.log('daerah '+district_id);

            $.ajax({
                type: "get",
                url: "/get_city_list",
                data: {
                    district_id : district_id
                },
                success: function(response) {
                    console.log('data' +response.data);

                    $('#city').empty();
                    $('#city').append('<option value="">-- Pilih Bandar/Pekan/Mukim --</option>')
                    $.each(response.data, function(key, value) {
                        var optionElement = '<option value="' + value.id + '">' + value.name + '</option>';
                        $('#city').append(optionElement);
                    });


                },
                error: function(response) {
                    alert(response);
                }
            });

        });

        // Use event delegation for dynamically created buttons
        $(document).on('click', '#simpan_location_button', function() {
            Swal.fire({
                title: 'Anda pasti?',
                text: "Anda pasti pin lokasi berapa ditempat yang betul?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pasti!',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/user/save_location',
                        data: $('#locationForm').serialize(),
                        success: function(response) {
                            console.log(response);

                            if(response.status == 'success'){

                                toastr.success(response.Message);

                            }
                            else{

                                toastr.error(response.Message);

                            }

                            $('#lot').val('');
                            $('#area').val('');
                            $('#state').val('');
                            $('#district').val('');
                            $('#city').val('');
                            $('#latitude').val('');
                            $('#longitude').val('');
                            
                            $('#notes_section').empty();
                            $('#option_button').empty();

                            var app = '';


                            app += '<button type="button" class="ms-3 cari_location text-white py-2 px-4 rounded-md" id="cari_location_button" style="background-color:#374151 !important; font-weight:bold !important;">';
                            app +=        'Cari';
                            app += '</button>';

                            $('#option_button').append(app);

                        },
                        error: function(xhr) {
                            console.log(xhr.responseJSON);
                            if (xhr.responseJSON && xhr.responseJSON.errors) {
                                let errors = xhr.responseJSON.errors;
                                for (let field in errors) {
                                    toastr.error(errors[field].join(' '), 'Validation Error');
                                }
                            } else {
                                toastr.error('There was an error submitting the form.', 'Error');
                            }
                        }
                    });
                }
            });
        });
        
    </script>

</x-app-layout>
