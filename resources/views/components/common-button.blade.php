@props(['href' => '#'])

<a href="{{ $href }}" {{ $attributes([ 'class' => 'transition-colors duration-300 text-xs font-semibold rounded-full py-2 px-8' ])}}>
    {{ $slot }}
</a>