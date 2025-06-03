@props([
    'name',
    'img'
])

<section class="about-sec" style="background-image: url({{ asset('images/category/'.$img) }})">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="inner-banner-hd">{{ $name }}</h2>
            </div>
        </div>
    </div>
</section>
