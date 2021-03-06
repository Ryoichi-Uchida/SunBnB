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
                            <form action="{{ route('photos.store', ['room' => $room->id]) }}" method="post" enctype="multipart/form-data" class="border-bottom">
                                @csrf
                                <div class="row d-flex justify-content-center">
                                    <label for="file_photo" class="file-decoration">
                                        + Please choose photos
                                        <input type="file" id="file_photo" name="photos[]" multiple="multiple" class="d-none" required>
                                    </label>
                                </div>
                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-base btn-size-mini btn-color-main">Add photos</button>
                                </div>
                            </form>

                            <div class="row">
                                @foreach ($room->photos as $photo)
                                    <div class="col-12 col-sm-6 col-lg-4 my-2" id="card-{{ $photo->id }}">
                                        <div class="card">
                                            <img src="{{ $photo->show("thumbnail") }}" alt="" class="card-img-top border">
                                            <div class="card-body py-2 ml-auto">
                                                <div class="row">

                                                    {{-- *Modal --}}
                                                    <div class="p-1 ml-auto ">
                                                        <a href="" class="" data-toggle="modal" data-target="#ModalDelete" data-photo={{ $photo->id }}><i class="fa fa-trash fa-lg text-main"></i></a>
                                                    </div>
                                                        
                                                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="ModalDeleteLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="ModalDeleteLabel">Are you sure you want to delete it?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="" class="btn btn-danger mx-1 btn-delete" data-dismiss="modal">Delete</button>
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
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

@section('script')
<script>
    $(document).ready(function(){
        var route = ''; // Defining global route for jQuery
        var photo_id = ''; // Defining global photo_id for jQuery

        // It makes data for Modal. 
        $('#ModalDelete').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Getting specific modal button
            photo_id = button.data('photo') //Updating id to delete funtion
            route = '/photos/'+photo_id // Updating route to delete funtion
        })

        // These are for ajax
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        $('.btn-delete').click(function(){
            $('.modal fade').modal('hide');
            $.ajax({
                type: 'DELETE',
                url: route,
                success: function(data){
                    $('#card-'+photo_id).remove();
                    if(data.active == 0){
                        // Removing check symbol
                        $("#check").text('');
                        // Adding disabled attr to publish button.
                        $("#disabled").prop('disabled', true);
                    }
                    toastr.success(data.message);
                },
                failed: function(data){
                    toastr.error(data.message);
                },
            });
        });
    });
</script>
@endsection