<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laman Utama Admin') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <!-- Toastr Success Message -->
                    @if(session('success'))
                        <script>
                            toastr.success('{{ session('success') }}', 'Berjaya', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 5000
                            });
                        </script>
                    @endif
                    @if(session('error'))
                        <script>
                            toastr.error('{{ session('error') }}', 'Gagal', {
                                closeButton: true,
                                progressBar: true,
                                timeOut: 5000
                            });
                        </script>
                    @endif
                    <div class="py-2">
                        <h3 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Senarai Pengguna GeoGeran.') }}
                        </h3>
                    </div>
                    <table class="min-w-full w-full divide-y divide-gray-200 mt-3">
                        <thead>
                            <tr style="border-bottom:1px solid black !important;">
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">#</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Nama Pengguna</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Email</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: center !important;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(!empty($users) && count($users) > 0)
                                @foreach($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap" style="text-align:center !important;">
                                            <form action="{{ route('admin.delete_user') }}" method="POST" id="deleteUserForm">
                                                @csrf
                                                <input type="text" name="id" value="{{ $user->id }}" hidden>
                                                <button type="button" class="text-white py-2 px-4 rounded-md" id="padam_pengguna" style="background-color:#374151 !important; font-weight:bold !important;">Padam</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="px-6 py-4 text-center text-gray-500">Tiada data direkodkan.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>

                    @if(!empty($users) && count($users) > 0)
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $users->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        
        // Use event delegation for dynamically created buttons
        $(document).on('click', '#padam_pengguna', function() {
            Swal.fire({
                title: 'Anda pasti?',
                text: "Anda pasti mahu padam pengguna ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Pasti!',
                cancelButtonText: 'Tidak, Batal!',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#deleteUserForm').submit();
                }
            });
        });

    </script>

</x-app-layout>
