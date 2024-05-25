@php
    use App\Enumeration\PostType;
@endphp
<x-layout>
    <x-setting :heading="'Edit Post: ' . $post->title">
        <form method="POST" action="/admin/posts/{{ $post->id }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            
            <div class="flex items-center mb-4">
                <div class="flex mr-4">
                    <input type="radio" name="status" value="{{ PostType::$Approved }}" {{ $post->status === PostType::$Approved ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2 block uppercase font-bold text-xs text-gray-700">Approved</span>
                </div>
                <div class="flex mr-4">
                    <input type="radio" name="status" value="{{ PostType::$Pending }}" {{ $post->status === PostType::$Pending ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2 block uppercase font-bold text-xs text-gray-700">Pending</span>
                </div>
                <div class="flex mr-4">
                    <input type="radio" name="status" value="{{ PostType::$Cancelled }}" {{ $post->status === PostType::$Cancelled ? 'checked' : '' }} class="form-radio text-green-600">
                    <span class="ml-2 block uppercase font-bold text-xs text-gray-700">Cancelled</span>
                </div>
            </div>
            
            <x-form.input name="title" :value="old('title', $post->title)"/>
            <x-form.input name="slug" :value="old('slug', $post->slug)"/>
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
                            {{ old('category_id', $post->category_id) == $category->id ? 'selected': '' }}
                        >
                            {{ucwords($category->name)}}
                        </option>
                    @endforeach
                </select>
                <x.form.error name="category" />
            </x-form.field>
            <x-form.button>Update</x-form.button>
        </form>
    </x-setting>
</x-layout>