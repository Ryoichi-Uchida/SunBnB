@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('partials.manage_menu')
        </div>
        <div class="col-md-9">
            <div class="row">
                <div class="col-12">
                    <div class="box-head">
                        <h3 class="my-0">Your Reservations</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="box-body">
                        <div class="col-10 m-auto">
                            @foreach ($reservations as $reservation)
                                @include('partials.reservation_menu',[
                                    'user' => $reservation->user,
                                    'target' => 'Guest',
                                    'type' => 'host'
                                ])
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center">
                            {{ $reservations->links() }}
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
    $(function(){
        var route = ''; // Defining global route for jQuery
        var reservation_id = ''; // Defining global id for jQuery

        // It makes data for Modal. 
        $('#ModalReview').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Getting specific modal button
            reservation_id = button.data('reservation') //Updating id
            route = '/reviews/'+reservation_id // Updating route
        })
    
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.btn-review').click(function(e){
            e.preventDefault();
            var form = document.forms["review_form"];
            $.ajax({
                type: 'POST',
                url: route,
                data: $(form).serialize(),
                dataType: 'json',
                success: function(data){
                    if(data.error != null){
                        toastr.error(data.message);
                    }else{
                        toastr.success(data.message);
                    }
                    document.getElementById("review_form").reset();
                }
            });
        });
    });
</script>
@endsection