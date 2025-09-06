<x-filament-widgets::widget>
    <x-filament::section>
        @php
            $user = auth()->user();
            $userName = $user->name;
            // Mengambil role pertama user dan membuat huruf depannya kapital
            $roleName = ucfirst($user->getRoleNames()->first());
            // Mengambil tanggal hari ini dan memformatnya dalam Bahasa Indonesia
            $date = \Carbon\Carbon::now()->locale('id')->translatedFormat('l, j F Y');

        @endphp

        <div class="flex items-center gap-x-4">

            {{-- Avatar Pengguna --}}
            <div class="flex-shrink-0">
                <img class="h-16 w-16 rounded-full object-cover" src="{{ filament()->getUserAvatarUrl($user) }}"
                    alt="Avatar {{ $userName }}">
            </div>

            {{-- Teks Sambutan --}}
            <div class="flex-1">
                <h2 class="... text-xl font-bold">
                    Selamat Datang Kembali, {{ $userName }}!
                </h2>
                <p class="... mt-1 text-base">
                    Anda login sebagai {{ $roleName }}. Hari ini, {{ $date }}.
                </p>
            </div>

        </div>
    </x-filament::section>
</x-filament-widgets::widget>
