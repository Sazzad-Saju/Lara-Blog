{{-- @props(['name', 'type' => 'text']) --}}
@props(['name'])
{{-- <div class='mb-6'> --}}
<x-form.field>
    {{-- <label class='block mb-2 uppercase font-bold text-xs text-gray-700'
        for='{{ $name }}'
    >
        {{ ucwords($name) }}
    </label> --}}
    <x-form.label name="{{ $name }}" />
    <input class='border border-gray-200 p-2 w-full rounded'
      {{-- type='{{ $type }}' --}}
      name='{{ $name }}'
      id='{{ $name }}'
      value="{{ old($name) }}"
      required
      {{ $attributes }}
    >
    <x-form.error name="{{ $name }}" />
    
</x-form.field>
{{-- </div> --}}