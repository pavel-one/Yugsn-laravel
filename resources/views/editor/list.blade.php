@php
    /** @var string $style */
    $tag = 'ul';

    if ($style === 'ordered') {
        $tag = 'ol';
    }
@endphp

<{{$tag}}>
    @foreach($items as $item)
        <li>
            {!! $item !!}
        </li>
    @endforeach
</{{$tag}}>
