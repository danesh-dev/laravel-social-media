<div class="container my-4">
    <div class="row">
        <div class="col-10 col-md-8 mx-auto">
            <div class="card">
                @if (!empty($post->image))
                    <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="Post Image">
                @endif
                <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-light">{{ '@' . $post->user->username }} ·
                        {{ $post->created_at->diffForHumans() }}</h6>
                    <hr class="text-light">
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->caption }}</p>

                    <a href="#" class="text-decoration-none text-light" id="like-unlike-{{ $post->id }}"
                        onclick="toggleLike({{ $post->id }})">

                        @if ($post->likes->where('user_id', auth()->id())->first())
                            <i class="fa fa-thumbs-up text-info"></i> Unlike
                        @else
                            <i class="fa fa-thumbs-up text-light"></i> Like
                        @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleLike(postId) {
        const likeUnlikeLink = document.getElementById(`like-unlike-${postId}`);
        const isLiked = likeUnlikeLink.querySelector('i').classList.contains('text-info');
        const url = `/posts/${postId}/likes`;
        const method = isLiked ? 'DELETE' : 'POST';

        fetch(url, {
                method: method,
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'liked') {
                    likeUnlikeLink.innerHTML = '<i class="fa fa-thumbs-up text-info"></i> Unlike';
                } else if (data.status === 'unliked') {
                    likeUnlikeLink.innerHTML = '<i class="fa fa-thumbs-up text-light"></i> Like';
                }
            })
            .catch(error => console.error('Error:', error));
    }
</script>
