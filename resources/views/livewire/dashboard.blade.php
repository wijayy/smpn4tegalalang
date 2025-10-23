<div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white dark:bg-neutral-700 p-4 rounded-lg shadow-xl min-h-40">
            <h3 class="text-lg font-semibold">Active Students</h3>
            <p class="text-3xl md:text-5xl mt-4 font-bold">{{ $activeStudents }}</p>
        </div>
        <div class="bg-white dark:bg-neutral-700 p-4 rounded-lg shadow-xl min-h-40">
            <h3 class="text-lg font-semibold">Active Teachers</h3>
            <p class="text-3xl md:text-5xl mt-4 font-bold">{{ $activeTeachers }}</p>
        </div>
        <div class="bg-white dark:bg-neutral-700 p-4 rounded-lg shadow-xl min-h-40">
            <h3 class="text-lg font-semibold">Total Classes</h3>
            <p class="text-3xl md:text-5xl mt-4 font-bold">{{ $totalClasses }}</p>
        </div>
        <div class="bg-white dark:bg-neutral-700 p-4 rounded-lg shadow-xl min-h-40">
            <h3 class="text-lg font-semibold">Total Prestasi</h3>
            <p class="text-3xl md:text-5xl mt-4 font-bold">{{ $totalPrestasi }}</p>
        </div>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">
        @livewire('dashboard.prestasi-chart')
        <div class="">
            <div class="">Prestasi Terakhir</div>
            <div class="mt-4 flex-col gap-2">
                @foreach ($lastPrestasi as $item)
                    <div class="flex justify-between border-b border-gray-300 dark:border-neutral-600 py-2">
                        <div class="">{{ $item->siswa->name }}</div>
                        <div class="">{{ $item->nama_prestasi }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
