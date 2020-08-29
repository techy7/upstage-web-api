@extends('layouts.metronic.classic.app')

@section('content')

<div class="mb-5">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> API Documentation
                </h3>
            </div>
             
        </div>
    </div> 
</div> 

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
