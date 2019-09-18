<div class="row py-2 my-2 border bg-white d-flex">
    <div class="col-5 col-sm-3 col-lg-2 d-flex align-items-center my-1">
        <span>{{ $reservation->checkin_at }}</span>
    </div>
    <div class="col-7 col-sm-3 col-lg-2 d-flex align-items-center my-1">
        <img src="{{ $reservation->room->show_photo("thumbnail") }}" alt="">
    </div>
    <div class="col-12 col-sm-6 col-lg-4 my-1">
        <h5><a href="{{ route('rooms.show', ['room' => $reservation->room->id]) }}">{{ $reservation->room->listing_name }}</a></h5>
        @include('partials.photo_space', [
            'user' => $user,
            'img_size' => 'img-sm-fb',
            'gravatar_size' => '30'
        ])
        <a href="{{ route('users.show', ['user' => $user->id]) }}" class="ml-2 h5">{{ $user->name }}</a>
    </div>
    <div class="col-12 col-sm-12 col-lg-4 d-flex align-items-center my-1">
        <a href="" class="btn btn-base btn-size-mini btn-color-spot d-flex align-content-center flex-wrap justify-content-center w-100" data-toggle="modal" data-target="#ModalReview" data-reservation={{ $reservation->id }}>
            <span class="h5 mb-0">Review {{ $target }}</span>
        </a>
    </div>

    {{-- Modal --}}                                        
    <div class="modal fade" id="ModalReview" tabindex="-1" role="dialog" aria-labelledby="ModalReviewLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalReviewLabel">Let's review the {{ $target }}.</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" name="review_form" id="review_form">
                        <input type="hidden" name="reviewer_type" value="{{ $type }}">
                        <div class="form-group">
                            <input type="text" name="star" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <textarea name="comment" id="" class="form-control" required placeholder="Please write your opinion..."></textarea>
                        </div>
                        <div class="text-right">
                            <button type="submit" class="btn btn-base bg-main mx-1 btn-review" data-dismiss="modal" id="review">Add Review</button>
                            <button type="" class="btn btn-base btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>