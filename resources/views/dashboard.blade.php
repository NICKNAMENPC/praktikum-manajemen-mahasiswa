<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Dashboard Sistem Manajemen Mahasiswa') }}
            </h2>
            <span class="inline-flex items-center gap-1.5 px-3 py-1 text-sm font-semibold rounded-full {{ Auth::user()->isAdmin() ? 'bg-indigo-100 text-indigo-800 border border-indigo-200' : 'bg-emerald-100 text-emerald-800 border border-emerald-200' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Role: {{ strtoupper(Auth::user()->role) }}
            </span>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50/50 min-h-[calc(100vh-12rem)]">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Welcome Banner -->
            <div class="bg-gradient-to-r from-indigo-600 via-indigo-700 to-purple-700 rounded-2xl shadow-xl overflow-hidden text-white p-8">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl font-extrabold tracking-tight">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                        <p class="mt-2 text-indigo-100 max-w-2xl text-base">
                            Anda login sebagai <span class="font-bold underline decoration-indigo-300 underline-offset-4">{{ strtoupper(Auth::user()->role) }}</span>.
                            @if(Auth::user()->isAdmin())
                                Anda memiliki wewenang penuh untuk melihat, menambah, mengedit, dan menghapus seluruh data mahasiswa.
                            @else
                                Anda memiliki akses terbatas untuk melihat daftar mahasiswa. Fitur penambahan, perubahan, dan penghapusan data dibatasi untuk Admin.
                            @endif
                        </p>
                    </div>
                    <div>
                        <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center gap-2 bg-white text-indigo-700 hover:bg-indigo-50 font-bold px-5 py-3 rounded-xl shadow-md transition-all duration-200 hover:scale-105">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            Buka Data Mahasiswa
                        </a>
                    </div>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Stat 1 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Total Mahasiswa</p>
                            <p class="text-3xl font-black text-gray-900 mt-2">{{ $totalMahasiswa }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 01-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-xs text-gray-500">
                        <span>Terdaftar dalam sistem</span>
                    </div>
                </div>

                <!-- Stat 2 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah Admin</p>
                            <p class="text-3xl font-black text-indigo-600 mt-2">{{ $totalAdmin }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-xs text-gray-500">
                        <span>Pengelola dengan hak akses penuh</span>
                    </div>
                </div>

                <!-- Stat 3 -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-500">Jumlah User</p>
                            <p class="text-3xl font-black text-emerald-600 mt-2">{{ $totalUser }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mt-4 pt-4 border-t border-gray-100 flex items-center text-xs text-gray-500">
                        <span>Pengguna biasa (Read-only)</span>
                    </div>
                </div>
            </div>

            <!-- Role Matrix & Info Card -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Recent Mahasiswa Table Preview -->
                <div class="lg:col-span-2 bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="font-bold text-gray-900 text-lg">Mahasiswa Terbaru</h3>
                        <a href="{{ route('mahasiswa.index') }}" class="text-xs font-semibold text-indigo-600 hover:text-indigo-800">Lihat Semua &rarr;</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-600">
                            <thead class="text-xs uppercase bg-gray-50 text-gray-500">
                                <tr>
                                    <th class="px-4 py-3">NIM</th>
                                    <th class="px-4 py-3">Nama</th>
                                    <th class="px-4 py-3">Program Studi</th>
                                    <th class="px-4 py-3">Angkatan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse($latestMahasiswa as $mhs)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="px-4 py-3 font-semibold text-indigo-600">{{ $mhs->nim }}</td>
                                        <td class="px-4 py-3 font-medium text-gray-900">{{ $mhs->nama }}</td>
                                        <td class="px-4 py-3">{{ $mhs->program_studi }}</td>
                                        <td class="px-4 py-3"><span class="bg-gray-100 text-gray-700 px-2 py-0.5 rounded text-xs">{{ $mhs->angkatan }}</span></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-6 text-center text-gray-400">Belum ada data mahasiswa.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Hak Akses Table Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 text-lg mb-4">Matriks Hak Akses</h3>
                    <div class="overflow-hidden border border-gray-200 rounded-xl">
                        <table class="w-full text-xs text-left">
                            <thead class="bg-gray-100 font-semibold text-gray-700 border-b border-gray-200">
                                <tr>
                                    <th class="p-2.5">Fitur</th>
                                    <th class="p-2.5 text-center">Admin</th>
                                    <th class="p-2.5 text-center">User</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-gray-600">
                                <tr>
                                    <td class="p-2.5 font-medium">Dashboard</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                </tr>
                                <tr>
                                    <td class="p-2.5 font-medium">Lihat Data</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                </tr>
                                <tr>
                                    <td class="p-2.5 font-medium">Tambah Data</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                    <td class="p-2.5 text-center text-rose-500 font-bold">✗ Tidak</td>
                                </tr>
                                <tr>
                                    <td class="p-2.5 font-medium">Ubah Data</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                    <td class="p-2.5 text-center text-rose-500 font-bold">✗ Tidak</td>
                                </tr>
                                <tr>
                                    <td class="p-2.5 font-medium">Hapus Data</td>
                                    <td class="p-2.5 text-center text-emerald-600 font-bold">✓ Ya</td>
                                    <td class="p-2.5 text-center text-rose-500 font-bold">✗ Tidak</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4 p-3 bg-indigo-50/70 border border-indigo-100 rounded-xl text-xs text-indigo-900">
                        <p class="font-semibold mb-1">🔐 Keamanan Server-side</p>
                        <p>Pembatasan diuji melalui <code>RoleMiddleware</code>. Pengguna dengan role <b>user</b> akan mendapatkan error <b>403 Forbidden</b> apabila mencoba mengakses URL pengubahan data secara langsung.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
