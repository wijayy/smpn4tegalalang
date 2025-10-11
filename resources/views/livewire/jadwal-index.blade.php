<div>
    @foreach ($jadwal as $item)
        <div class="flex justify-between items-center">

            <div class="">{{ $item->kelas->nama }}</div>
            <div class="">{{ $item->jam_ke }}</div>
            <div class="">{{ $item->hari }}</div>
            <div class="">{{ $item->guru->name }}</div>
            <div class="">{{ $item->mapel->nama }}</div>
        </div>
    @endforeach
</div>
