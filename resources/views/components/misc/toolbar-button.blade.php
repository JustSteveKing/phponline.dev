<button type="button" {{ $attributes->merge(['class' => 'bg-white focus:ring-indigo-500 focus:border-indigo-500 border border-transparent py px-4 rounded']) }}>
    {{ $slot }}
</button>
