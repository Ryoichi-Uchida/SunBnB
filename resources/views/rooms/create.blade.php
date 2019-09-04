@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <div class="box-head">
                <h3 class="my-0">Create your beautiful place</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="box-body">
                <div class="col-10 m-auto">
                    @include('partials.room_edit_space')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
