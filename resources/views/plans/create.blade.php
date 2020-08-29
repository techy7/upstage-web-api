@extends('layouts.metronic.classic.app')

@section('content')
<plans-form 
    :objplan="{{$plan}}"
    url="{{url('/admin_api/plans')}}"
    action="post"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-map-location"></i> Create New Plan
                </h3>
            </div>
            <div>
                <a :href="'/plans/'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-secondary">Cancel</span>
                        <span class="btn btn-secondary m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="flaticon-close m--font-secondary"></i>
                        </span> 
                    </span>
                </a>  
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col-md-12">
                @include('plans.form')
            </div>
        </div>
    </div>
</div> 
</plans-form>
@endsection
