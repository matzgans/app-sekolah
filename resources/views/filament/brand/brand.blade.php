<div class="flex items-center gap-2">
    <img class="h-8" src="{{ Storage::url('fixlogo.png') ?? asset('assets/img/logofix.png') }}" alt="Logo">
    <span class="text-lg font-bold">{{ optional($profileSekolah)->nama_sekolah }}</span>
</div>
