<x-layout>
    <x-setting heading="Publish New Post">
        <form method="POST" action="/admin/posts" enctype="multipart/form-data">
            @csrf
            
            <x-form.input name="title" />
            <x-form.input name="slug" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.input name="excerpt" />
            <x-form.input name="body" />
            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected': '' }}
                        >
                            {{ucwords($category->name)}}
                        </option>
                    @endforeach
                </select>
                <x.form.error name="category" />
            </x-form.field>
            {{-- <div class='mb-6'>
                <label class='block mb-2 uppercase font-bold text-xs text-gray-700'
                    for='body'
                >
                    body
                </label>
                <textarea class="border border-gray-400 p-2 w-full" 
                    name="body" 
                    id="body" 
                    required>
                    {{ old('body') }}
                </textarea>
                @error('body')
                    <p class='text-red-500 text-xs mt-2'>{{ $message }}</p>
                @enderror
            </div> --}}
            
            {{-- <div class='mb-6'>
                <label class='block mb-2 uppercase font-bold text-xs text-gray-700'
                    for='category_id'
                >
                    Category
                </label>
                <select name="category_id" id="category">
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{ old('category_id') == $category->id ? 'selected': '' }}
                        >
                            {{ucwords($category->name)}}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class='text-red-500 text-xs mt-2'>{{ $message }}</p>
                @enderror
            </div> --}}
            {{-- <x-submit-button>Publish</x-submit-button> --}}
            <x-form.button>Publish</x-form.button>
        </form>
    </x-setting>
</x-layout>