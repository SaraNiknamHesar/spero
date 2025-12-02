@props(['messages'])

@if ($messages)
    @foreach ($messages as $massage)
        <span {{ $attributes->merge(['class' => 'text-danger']) }}>
            {{ $massage }}
        </span>

    @endforeach
@endif