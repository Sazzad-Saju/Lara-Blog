<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            {{-- <x-form.input name="title" :value="$post->title"/> --}}
            <x-form.input name="title" :value="old('title', $post->title)"/>
            <x-form.input name="slug" :value="old('slug', $post->slug)"/>
            {{-- <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/> --}}
            <div class="flex mt-6">
                <div class="flex-1">
                    <x-form.input name="thumbnail" type="file" :value="old('thumbnail', $post->thumbnail)"/>  
                </div>
                <img src="{{asset('storage/' . $post->thumbnail)}}" alt="" class="rounded-xl ml-6" width="100">
            </div>
            <x-form.textarea name="excerpt" required>{{ old('excerpt', $post->excerpt) }}</x-form.textarea>
            <x-form.textarea name="body" required>{{ old('body', $post->body) }}</x-form.textarea>
            <x-form.field>
                <x-form.label name="category" />
                <select name="category_id" id="category" required>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}"
                            {{-- {{ old('category_id') == $category->id ? 'selected': '' }} --}}
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected': '' }}
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
            {{-- <x-form.button>Publish</x-form.button> --}}
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>