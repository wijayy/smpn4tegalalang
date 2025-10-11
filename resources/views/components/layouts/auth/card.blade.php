<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen  antialiased">
    <div class="flex min-h-svh flex-col items-center justify-center gap-6 p-6 md:p-10 bg-center bg-no-repeat bg-cover" style="background-image: url({{ asset('asset/login.jpg') }})">
        <div class="flex w-full max-w-md flex-col gap-6">
            <div class="flex flex-col gap-6">
                <div
                    class="rounded-xl bg-white/40 backdrop-blur-sm dark:bg-stone-950/40 dark:border-stone-800 text-stone-800 shadow-xs">
                    <a href="{{ route('home') }}" class="flex flex-col  items-center gap-2 pt-10 font-medium" wire:navigate>
                        <span class="flex size-12 md:size-20 items-center justify-center rounded-md">
                            <x-app-logo-icon class="size-9 fill-current text-black dark:text-white" />
                        </span>

                        <span class="sr-only">{{ config('app.name', 'Laravel') }}</span>
                    </a>
                    <div class="px-10 mt-4 pb-8">{{ $slot }}</div>
                </div>
            </div>
        </div>
    </div>
    @fluxScripts
</body>

</html>
