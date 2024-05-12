@props(['name'])
{{-- <div class='mb-6'> --}}
<x-form.field>
    <x-form.label name="{{ $name }}" />
    <textarea class='border border-gray-400 p-2 w-full rounded'
      name='{{ $name }}'
      id='{{ $name }}'
      required
    >
        {{ $slot ?? old( $name ) }}
    </textarea>
    <x-form.error name="{{ $name }}" />
{{-- </div> --}}
</x-form.field>