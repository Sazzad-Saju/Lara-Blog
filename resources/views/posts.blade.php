<x-layout>
    @include('_posts-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        @if($posts->count() > 0)
            {{-- reusable component  --}}
            <x-post-grid :posts="$posts" />
        @else
            <p class="text-center">No posts yet. Please check later!</p>
        @endif
    </main>
</x-layout>
