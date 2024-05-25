@php
    use App\Enumeration\PostType;
@endphp
<x-layout>
    <x-setting heading="Manage Your Posts">
        <div class="mb-4 flex justify-end">
        </div>
        <div class="flex flex-col">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    <a href="/posts/{{ $post->slug }}">
                                                        {{ $post->title }}
                                                    </a>
                                                </div>
                                            </div>
                                        <td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if($post->status === PostType::$Approved)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                    Approved
                                                </span>
                                            @elseif($post->status === PostType::$Pending)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                    Pending
                                                </span>
                                            @elseif($post->status === PostType::$Cancelled)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Declined
                                                </span>
                                            @endif
                                        </td>
                                            
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <a href="/posts/{{ $post->id }}/edit" class="text-blue-500 hover:text-blue-600">Edit</a>
                                        </td>
                                        
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <form method="POST" action="/posts/{{ $post->id }}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-xs text-gray-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                <div class="text-sm font-medium text-gray-900">
                                                    You have no posts yet!
                                                </div>
                                            </div>
                                        <td>
                                    </td>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-setting>
</x-layout>