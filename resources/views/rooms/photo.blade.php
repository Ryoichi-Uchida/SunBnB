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
                                        <img src="/{{ $photo->images_directry("thumbnail") }}/{{ $photo->image }}" alt="" class="w-100">
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
