@props(['name', 'image'])

@php
    $path = $image ?: '/defaults/avatar.jpg';

    // If the file does NOT exist physically, use the default avatar
    // راه استاد جواب نداد منم اومدم اینو گذاشتم که بخونه 
    if (!\Illuminate\Support\Facades\File::exists(public_path($path))) {
        $path = '/defaults/avatar.jpg';
    }
@endphp

<div style="background-image: url({{ $path }}); background-size: cover;"
     {{ $attributes->merge(['id' => 'image-preview', 'class' => 'ms-2 mb-2']) }}>
    <label for="image-upload" id="image-label">Choose File</label>
    <input type="file" name="{{ $name }}" id="image-upload" />
</div>
