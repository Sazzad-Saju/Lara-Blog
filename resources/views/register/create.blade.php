<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 border border-gray-200 p-6 rounded-xl">
            <h1 class="text-center font-bold text-xl">Register!</h1>
            <form action="/register" method="POST" class="mt-10">
                @csrf
                <x-form.input name="name" />
                <x-form.input name="user_name" />
                <x-form.input name="email" />
                <x-form.input name="password" type="password" autocomplete="new-password" />
                <x-form.button>Sign Up</x-form.button>
            </form>
        </main>
    </section>
</x-layout>