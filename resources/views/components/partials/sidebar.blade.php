<div x-show="sidebarOpen" @click="sidebarOpen = false" class="fixed inset-0 z-[25] md:hidden" style="background: none;"
    aria-hidden="true">
</div>

<aside x-show="sidebarOpen" x-transition:enter="transition ease-in-out duration-300 transform"
    x-transition:enter-start="-translate-x-full" x-transition:enter-end="translate-x-0"
    x-transition:leave="transition ease-in-out duration-300 transform" x-transition:leave-start="translate-x-0"
    x-transition:leave-end="-translate-x-full" :class="sidebarCollapsed ? 'w-20' : 'w-64'"
    class="bg-university-red text-white fixed md:static inset-y-0 left-0 z-30 overflow-y-auto transition-all duration-300 shadow-lg flex flex-col"
    style="display: none;">

    {{-- ✅ Logo closes properly here --}}
    <a wire:navigate href="{{ route('home') }}"
        class="flex items-center justify-center h-16 border-b border-red-900 flex-shrink-0 hover:bg-black/10 transition-colors duration-200">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('images/eeevsu.jpg') }}" alt="EVSU Logo" class="w-10 h-10"
                style="border-radius: 50%; object-fit: cover; border: 2px solid rgba(255, 255, 255, 0.3); box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);">
            <span x-show="!sidebarCollapsed" x-transition
                class="text-white tracking-widest uppercase"
                style="font-family: 'Cormorant Garamond', serif; font-size: 1.35rem; letter-spacing: 0.12em;">
                Thesis<em style="font-style: italic; font-weight: 700; letter-spacing: 0.06em;">Hub</em>
            </span>
        </div>
    </a>{{-- ✅ <a> tag is now properly closed before <nav> --}}

    {{-- ✅ Nav is now outside the <a> tag --}}
    <nav class="mt-2 px-3 flex-1 overflow-y-auto pb-20">

        @can('view-dashboard')
        <x-partials.sidebar-link href="{{ route('dashboard.index') }}" route="dashboard*" label="Dashboard">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M3 12l2-2 7-7 7 7" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        @can('viewAny', App\Models\User::class)
        <x-partials.sidebar-link href="{{ route('users.index') }}" route="users.*" label="Users">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M12 4a4 4 0 110 8 4 4 0 010-8zm-8 16a6 6 0 0116 0" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        @can('view-approvals')
        <x-partials.sidebar-link href="{{ route('approvals.index') }}" route="approvals.*" label="Account Approvals">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        @can('viewAny', App\Models\Category::class)
        <x-partials.sidebar-link href="{{ route('categories.index') }}" route="categories.*" label="Categories">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M7 3h5l7 7-7 7H7L3 12V7a4 4 0 014-4z" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        @can('create', App\Models\Document::class)
        <x-partials.sidebar-link href="{{ route('uploads.index') }}" route="uploads.*" label="Upload">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M15 13l-3-3-3 3m3-3v12" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        @can('viewAny', App\Models\Document::class)
        <x-partials.sidebar-link href="{{ route('documents.index') }}" route="documents.*" label="Documents">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586l5.414 5.414" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        <x-partials.sidebar-link href="{{ route('read-later.index') }}" route="read-later.*" label="Read Later">
            <x-slot:icon>
                <div class="relative inline-block">
                    <x-partials.sidebar-icon path="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                    @auth
                    @livewire('read-later.unread-count')
                    @endauth
                </div>
            </x-slot:icon>
        </x-partials.sidebar-link>

        @auth
        <x-partials.sidebar-link href="{{ route('notifications.index') }}" route="notifications.*" label="Notifications">
            <x-slot:icon>
                <x-partials.sidebar-icon path="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 00-5-5.917V4a1 1 0 10-2 0v1.083A6 6 0 006 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endauth

        @can('viewAny', App\Models\AuditLog::class)
        <x-partials.sidebar-link href="{{ route('audit-logs.index') }}" route="audit-logs.*" label="Audit Logs">
            <x-slot:icon>
                <x-partials.sidebar-icon
                    path="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
            </x-slot:icon>
        </x-partials.sidebar-link>
        @endcan

        <hr class="my-4 border-red-900" x-show="!sidebarCollapsed">
    </nav>

    <div class="border-t border-red-900 p-4 flex-shrink-0">
        <button @click="sidebarCollapsed = !sidebarCollapsed"
            class="w-full text-sm font-medium opacity-80 hover:opacity-100 transition">
            Collapse
        </button>
    </div>

</aside>