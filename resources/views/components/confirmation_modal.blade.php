<div
    x-data="{
        show: false,
        title: '',
        message: '',
        type: 'warning',
        method: '',
        params: null,
        componentId: '' // <-- 1. Siapkan state untuk ID Komponen
    }"
    @open-confirm.window="
        show = true;
        title = $event.detail.title;
        message = $event.detail.message;
        type = $event.detail.type || 'warning';
        method = $event.detail.method;
        params = $event.detail.params;
        componentId = $event.detail.componentId; // <-- 2. Tangkap ID Komponen
    "
    x-show="show"
    style="display: none;"
    class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-gray-900/50 backdrop-blur-sm"
    x-transition:enter="ease-out duration-300"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
>
    <div
        @click.away="show = false"
        x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave="ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        class="relative w-full max-w-sm p-6 mx-4 bg-white rounded-2xl shadow-2xl"
    >
        <div class="flex flex-col items-center text-center">

            <div class="flex items-center justify-center w-16 h-16 mb-4 rounded-full"
                 :class="{
                    'bg-red-100 text-red-600': type === 'danger',
                    'bg-yellow-100 text-yellow-600': type === 'warning',
                    'bg-green-100 text-green-600': type === 'success',
                    'bg-blue-100 text-blue-600': type === 'info'
                 }">

                <svg x-show="type === 'danger'" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>

                <svg x-show="type === 'warning'" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" /></svg>

                <svg x-show="type === 'success'" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="20 6 9 17 4 12" /></svg>

                <svg x-show="type === 'info'" class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><path stroke-linecap="round" stroke-linejoin="round" d="M12 16v-4m0-4h.01" /></svg>
            </div>

            <h3 class="text-lg font-bold text-gray-900" x-text="title"></h3>
            <p class="mt-2 text-sm text-gray-500" x-text="message"></p>
        </div>

        <div class="flex gap-3 mt-6">
            <button @click="show = false" type="button" class="flex-1 px-4 py-2.5 text-sm font-bold text-gray-700 bg-gray-100 rounded-xl hover:bg-gray-200 transition-colors">
                Batal
            </button>

            <button
                @click="
                if(componentId && method) {
                    Livewire.find(componentId).call(method, params);
                }
                show = false;
            "
                type="button"
                class="flex-1 px-4 py-2.5 text-sm font-bold text-white rounded-xl transition-all"
                :class="{
                'bg-red-600 hover:bg-red-700': type === 'danger',
                'bg-yellow-500 hover:bg-yellow-600': type === 'warning',
                'bg-[#07E200] hover:opacity-90': type === 'success',
                'bg-blue-600 hover:bg-blue-700': type === 'info'
            }"
            >
                Ya, Lanjutkan
            </button>
        </div>
    </div>
</div>
