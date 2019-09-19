<div class="row border-bottom pt-2 pb-1" id="review-{{ $review->id }}">
    <div class="col-4 col-md-2 my-1 text-center">
        @include('partials.photo_space', [
            'user' => $review->guest_user,
            'img_size' => 'img-md-fb',
            'gravatar_size' => '80'
        ])
        <span class="h4">{{ $review->guest_user->name }}</span>
    </div>
    <div class="col-6 col-md-8 my-1">
        <div id="star" class="star" data-score="{{ $review->star }}"></div>
        <p>{{ date('Y-m-d', strtotime($review->created_at)) }}</p>
        <p>{{ $review->comment }}</p>
    </div>
    <div class="col-2 d-flex align-items-center my-1">
        @if (Auth::user()->id == $review->guest_user->id)
            <form action="{{ route('reviews.destroy',['review' => $review->id]) }}" method="post">
                @method('DELETE')
                @csrf
                <input type="submit" value="&#xf1f8" class="fa fa-trash fa-lg text-main px-0 input-none">
            </form>
        @else
            <span>-</span>
        @endif
    </div>
</div>