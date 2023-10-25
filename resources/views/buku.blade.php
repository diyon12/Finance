<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-auto">
                    <div class="ml-3.5">
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block mb-3 flex-1 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                            Tambah Data Buku
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
                                    <form class="space-y-6" action="/store_buku" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div>
                                            <label for="Jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kategori</label>
                                            <input type="text" name="kategori" id="kategori" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <div>
                                            <label for="Jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul Buku</label>
                                            <input type="text" name="judul_buku" id="judul_buku" placeholder="" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <div>
                                            <label for="Jumlah" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cover</label>
                                            <input type="file" name="cover" id="cover" placeholder="123" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <div>
                                            <label for="Keterangan" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">File Buku</label>
                                            <input type="file" name="file" id="file" placeholder="ket" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white" required>
                                        </div>
                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="text-right m-3">
                        <form action="{{ route('hapusData', Auth::user()->id) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger bg-red-500 p-3 rounded text-white">Hapus</button>
                        </form>                        
                    </div>
                    <table id="example" class="hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kategori</th>
                                <th>Cover Buku</th>
                                <th>Judul Buku</th>
                                <th>Aksi</th>
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
                                        {{$item->kategori}} / {{$item->id}}
                                    </td>
                                    <td>
                                        <img src="{{ asset('storage/covers/'.$item->cover) }}" width="100px">
                                    </td>
                                    <td>
                                        {{$item->judul_buku}}
                                    </td>
                                    <td>
                                        <a href="/detail_buku/{{$item->id}}" class="bg-green-400 p-2 rounded text-white">Detail</a>
                                        {{-- <iframe src="{{ asset('storage/files/'.$item->file) }}" frameborder="10"></iframe>
                                        <button type="submit"  data-modal-target="review-modal" data-modal-toggle="review-modal{{$item->id}}" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            Lihat Buku
                                        </button> --}}
                                        {{-- <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Simpan</button> --}}
                                    </td>
                                </tr>
                                <div id="review-modal{{$item->id}}" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative w-full max-w-full max-h-full">
                                        <div class="bg-white rounded-lg">
                                            <a href="{{ route('buku') }}" class="bg-black p-3 text-white">Kembali</a>
                                            <div class="relative overflow-hidden">
                                                <iframe src="{{ asset('storage/files/'.$item->file) }}" style="width:100%; height:500px;" frameborder="0"></iframe>
                                                {{-- <embed src="{{ asset('storage/files/'.$item->file) }}" type="application/pdf" width="100%" height="600px" /> --}}
                                            </div>
                                        </div>
                                    </div>
                                </div> 
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
