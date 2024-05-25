@if (session()->has('success'))
    <div class="bg-blue-500 bottom-3 fixed px-4 py-2 right-0 right-3 rounded-xl text-sm text-white"
        x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show">
        <p>{{ session('success') }}</p>
    </div>
@endif
