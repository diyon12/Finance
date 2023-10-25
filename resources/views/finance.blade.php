<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Finance') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="text-left">
                        <div class="text-xl flex-1">Whole : Rp.3.412.000 / Rp.{{number_format($total)}}</div>
                        <div class="text-xl flex-1">remaining : Rp.1.457.000</div>
                    </div>
                    <div class="text-right">
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block mb-3 flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Data Transaksi
                        </button>
                    </div>
                    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Tutup</span>
                                </button>
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Data Transaksi Atau Pengeluaran</h3>
                                    <form class="space-y-6" action="/store_finance" method="POST">
                                        @csrf
                                        <div>
                                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jenis Transaksi</label>
                                            <select name="Jenis_Transaksi" id="Jenis_Transaksi" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" placeholder="name@company.com" required>
                                                <option>Pilih Jenis Transaksi</option>
                                                <option value="Masuk">Masuk</option>
                                                <option value="Keluar">Pengeluaran</option>
                                                <option value="Sisa">Sisa Uang</option>
                                            </select>
                                        </div>
                                        <div>
                                            <label for="Jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Jumlah</label>
                                            <input type="number" name="Jumlah" id="Jumlah" placeholder="123" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <div>
                                            <label for="Keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Keterangan</label>
                                            <input type="text" name="Keterangan" id="Keterangan" placeholder="ket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <table id="example" class="hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Transaksi</th>
                                <th>Jumlah</th>
                                <th>Keterangan</th>
                                <th>Tanggal Transaksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        @if ($item->Jenis_Transaksi == 'Masuk')
                                            <div class="bg-green-400 p-1 rounded text-white text-center text-lg">Pemasukkan</div>
                                            @else
                                            <div class="bg-red-500 p-2 rounded text-white text-center text-lg">Pengeluaran</div>
                                        @endif
                                    </td>
                                    <td>Rp.{{number_format($item->Jumlah)}}</td>
                                    <td>{{$item->Keterangan}}</td>
                                    <td>{{$item->Tanggal_Transaksi}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
        function formatAngka() {
          var inputElement = document.getElementById("Jumlah");
          var angka = inputElement.value.replace(/\D/g, ""); // Hapus karakter non-digit
          angka = parseInt(angka, 10); // Konversi ke angka
          inputElement.value = angka.toLocaleString("id-ID"); // Format sebagai angka dengan pemisah ribuan
        }
      </script> --}}
    
</x-app-layout>
