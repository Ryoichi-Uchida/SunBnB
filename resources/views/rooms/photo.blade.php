@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials.room_menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <h3 class="my-0">Photos</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">

                        <div class="col-10 m-auto">
                            <form action="{{ route('photo.store', ['room' => $room->id]) }}" method="post" enctype="multipart/form-data" class="border-bottom">
                                @csrf
                                <div class="row d-flex justify-content-center">
                                    <div class="form-group col-12 col-md-10">
                                        <input type="file" name="photos[]" multiple="multiple" required>
                                    </div>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-base btn-size-mini btn-color-main w-25">Add photos</button>
                                </div>
                            </form>
                            <div class="row">
                                @foreach ($room->photos as $photo)
                                    <div class="col-4 my-3">
                                        <img src="/{{ $photo->image_directory("thumbnail") }}" alt="" class="w-100">
                                        <button class="btn-delete">delete</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                         {{-- <div class="row">
                            <div class="modal">
                                <div id="login-form">
                                    <h2>Are you sure you want to delete it?</h2>
                                    <form action="" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger mx-1">
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                    <a href="" class="btn btn-secondary float-right">Back to Category list</a>
                                </div>
                            </div>
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
    // $(document).ready(function(){
    //     $('.btn-delete').click(function(){
    //         console.log('You clicked!');
    //     });
    // });

    // $(document).ready(function(){
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     })

    //     $('.btn-delete').click(function(){
    //         //delete

    //         $.ajax({
    //             type: 'DELETE',
    //             url: '{{ route('photo.destroy', ['id' => $photo->id]) }}',
    //             // url: '/photos/{{ $photo->id }}',
    //             // data: {_method: 'delete', _token :token},
    //             success: function(data){
    //                 console.log('success!');
    //             },
    //             failed: function(data){
    //                 console.log('failed!');
    //             },
    //         });
    //     });
    // });

</script>
@endsection