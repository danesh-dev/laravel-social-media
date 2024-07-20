<div class="container my-4">
    <div class="row">
        <div class="col-10 col-md-8 mx-auto">
            <div class="card">
                @if (!empty($image))
                    <img src="{{ $image }}" class="card-img-top" alt="Post Image">
                @endif
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-light">{{ '@' . $username }} · {{ $time }}</h6>
                    <hr class="text-light">
                    <h5 class="card-title">{{ $title }}</h5>
                    <p class="card-text">{{ $caption }}</p>
                    <a href="#" class="text-decoration-none text-light"><i class="fa fa-thumbs-up text-info"></i> unlike</a>
                    <a href="#" class="text-decoration-none text-light"><i class="fa fa-thumbs-up text-light"></i> like</a>
                </div>
            </div>
        </div>
    </div>
</div>
