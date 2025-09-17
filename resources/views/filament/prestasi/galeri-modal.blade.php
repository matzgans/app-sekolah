<div class="grid grid-cols-2 gap-4 md:grid-cols-3">
    @forelse($galeris as $galeri)
        <div class="flex flex-col items-center">
            <img class="h-40 w-full rounded-lg object-cover shadow" src="{{ Storage::url($galeri->gambar) }}"
                alt="{{ $galeri->keterangan }}">

            @if ($galeri->keterangan)
                <p class="mt-1 text-sm text-gray-600">{{ $galeri->keterangan }}</p>
            @endif
        </div>
    @empty
        <p class="col-span-3 text-gray-500">Belum ada gambar</p>
    @endforelse
</div>
