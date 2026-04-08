<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'University Thesis Hub' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,600;1,700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('styles')
    @livewireStyles
</head>

<body class="bg-slate-50 font-sans antialiased">
    <div x-data="adminLayout()" @resize.window="onResize()" class="flex h-screen overflow-hidden">

        <div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false"
            class="fixed inset-0 z-20 md:hidden bg-black/50 backdrop-blur-sm transition-opacity">
        </div>

        <x-partials.sidebar />

        <div class="flex-1 flex flex-col overflow-hidden">
            <x-partials.header />

            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        <livewire:auth.logout />
        <x-ui.confirmation-modal />

        <x-ui.toast />
    </div>

    @stack('scripts')
    @livewireScripts
    <script>
        function adminLayout() {
            return {
                sidebarOpen: window.innerWidth >= 768,
                sidebarCollapsed: false,
                logoutModalOpen: false,

                onResize() {
                    this.sidebarOpen = window.innerWidth >= 768;
                },

                toggleSidebar() {
                    this.sidebarOpen = !this.sidebarOpen;
                },

                confirmLogout() {
                    this.logoutModalOpen = true;
                }
            }
        }
    </script>
</body>

</html>
