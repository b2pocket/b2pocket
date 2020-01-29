@extends('layouts.admin_dash')



@section('page_heading','DASH')
@section('section')


{{-- @if(Auth::user()->role == 'admin')
@endif --}}


{{--
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
--}}

 @section('mojJs')
 <script async src="https://static.codepen.io/assets/embed/ei.js"></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/pixi.js/2.0.0/pixi.js"></script>
<script></script>
<script async src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
@stop


@endsection
