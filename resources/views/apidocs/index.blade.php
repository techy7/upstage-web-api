@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-5">
                @include('apidocs.includes.authentication')
            </div>

            <div class="card mb-5">
                @include('apidocs.includes.profile')
            </div>

            <div class="card mb-5">
                @include('apidocs.includes.listing')
            </div>

            <div class="card mb-5">
                @include('apidocs.includes.item')
            </div>
        </div>
    </div>
</div>
@endsection
