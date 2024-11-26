<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Laman Utama Pengguna') }}
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
                            {{ __('Senarai Data GeoGeran Direkodkan.') }}
                        </h3>
                    </div>
                    <table class="min-w-full w-full divide-y divide-gray-200 mt-3">
                        <thead>
                            <tr style="border-bottom:1px solid black !important;">
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">#</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Lot</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Tempat</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Bandar/Pekan/Mukim</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Daerah</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: left !important;">Negeri</th>
                                <th class="px-6 py-3 text-lg font-medium text-gray-500 uppercase tracking-wider" style="text-align: center !important;">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @if(!empty($lists) && count($lists) > 0)
                                @foreach($lists as $location)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->lot }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->area }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->city->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->district->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $location->state->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap" style="text-align: center !important;">
                                            <a href="{{ route('user.edit_location', $location->id) }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                                Kemaskini
                                            </a>
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

                    @if(!empty($lists) && count($lists) > 0)
                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $lists->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
