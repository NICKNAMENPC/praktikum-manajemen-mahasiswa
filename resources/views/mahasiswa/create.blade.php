<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight">
                {{ __('Tambah Data Mahasiswa Baru') }}
            </h2>
            <a href="{{ route('mahasiswa.index') }}" class="inline-flex items-center gap-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold px-4 py-2 rounded-xl text-sm transition-colors">
                &larr; Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8 bg-gray-50/50 min-h-[calc(100vh-12rem)]">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-200 overflow-hidden p-8">
                
                <div class="mb-6 pb-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900">Formulir Pendaftaran Mahasiswa</h3>
                    <p class="text-sm text-gray-500">Isi seluruh bidang data di bawah ini secara lengkap.</p>
                </div>

                <form method="POST" action="{{ route('mahasiswa.store') }}" class="space-y-6">
                    @csrf

                    <!-- NIM -->
                    <div>
                        <x-input-label for="nim" :value="__('NIM (Nomor Induk Mahasiswa)')" class="font-semibold" />
                        <x-text-input id="nim" name="nim" type="text" class="mt-1 block w-full rounded-xl" :value="old('nim')" placeholder="Contoh: 220101099" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('nim')" />
                    </div>

                    <!-- Nama -->
                    <div>
                        <x-input-label for="nama" :value="__('Nama Lengkap Mahasiswa')" class="font-semibold" />
                        <x-text-input id="nama" name="nama" type="text" class="mt-1 block w-full rounded-xl" :value="old('nama')" placeholder="Masukkan nama lengkap mahasiswa" required />
                        <x-input-error class="mt-2" :messages="$errors->get('nama')" />
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <x-input-label for="program_studi" :value="__('Program Studi')" class="font-semibold" />
                        <select id="program_studi" name="program_studi" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-xl shadow-sm" required>
                            <option value="" disabled {{ old('program_studi') ? '' : 'selected' }}>-- Pilih Program Studi --</option>
                            <option value="Teknik Informatika" {{ old('program_studi') == 'Teknik Informatika' ? 'selected' : '' }}>Teknik Informatika</option>
                            <option value="Sistem Informasi" {{ old('program_studi') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                            <option value="Rekayasa Perangkat Lunak" {{ old('program_studi') == 'Rekayasa Perangkat Lunak' ? 'selected' : '' }}>Rekayasa Perangkat Lunak</option>
                            <option value="Sains Data" {{ old('program_studi') == 'Sains Data' ? 'selected' : '' }}>Sains Data</option>
                            <option value="Teknik Komputer" {{ old('program_studi') == 'Teknik Komputer' ? 'selected' : '' }}>Teknik Komputer</option>
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('program_studi')" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email Student')" class="font-semibold" />
                        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-xl" :value="old('email')" placeholder="mahasiswa@student.ac.id" required />
                        <x-input-error class="mt-2" :messages="$errors->get('email')" />
                    </div>

                    <!-- Angkatan -->
                    <div>
                        <x-input-label for="angkatan" :value="__('Tahun Angkatan')" class="font-semibold" />
                        <x-text-input id="angkatan" name="angkatan" type="number" min="2000" max="2099" class="mt-1 block w-full rounded-xl" :value="old('angkatan', date('Y'))" placeholder="Contoh: 2024" required />
                        <x-input-error class="mt-2" :messages="$errors->get('angkatan')" />
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-center justify-end gap-3 pt-6 border-t border-gray-100">
                        <a href="{{ route('mahasiswa.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-50 text-sm font-semibold transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2.5 rounded-xl bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-bold shadow-md hover:shadow-lg transition-all">
                            Simpan Data Mahasiswa
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
