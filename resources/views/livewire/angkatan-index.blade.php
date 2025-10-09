<div class="">
    <div class="flex justify-end">
        <flux:button as href="{{ route('angkatan.create') }}" variant="primary">Tambah Angkatan</flux:button>
    </div>
    <div class="flex gap-4 py-2">
        <div class="w-10">#</div>
        <div class="w-1/2">Angkatan</div>
        <div class="w-1/2 text-center">Jumlah Siswa</div>
    </div>
    @foreach ($angkatan as $key => $item)
        <div class="flex gap-4 py-2">
            <div class="w-10">{{ $key + 1 }}</div>
            <div class="w-1/2">{{ $item->tahun_mulai }}-{{ $item->tahun_selesai }}</div>
            <div class="w-1/2 text-center">{{ $item->siswa->count() }}</div>
        </div>
    @endforeach
</div>
