@props(['image', 'name', 'description'])

<div class="stand-item col-lg-3" style="overflow: hidden">
    <img class="img-fluid" src="{{ asset('images/blogs/' . $image) }}" alt="">
    <div class="mt-3">
        <h4 class="stand-hd">{{ $name }}</h4>
        <p class="mb-2 lead">{{ $description }}</p>
        <a href="#" class="read-more">Read More</a>
    </div>
</div>
