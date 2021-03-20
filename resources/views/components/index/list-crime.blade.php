@php
    /** @var \App\Models\UserMaterial[] $materials */
    /** @var \App\Models\MaterialCategory $category */
@endphp

<h1>{{ $category->name }}</h1>
@foreach($materials as $material)
    <p>{{ $material->title }}</p>
@endforeach
