@extends('layouts.metronic.classic.app')

@section('content')
<templates-form 
    :objtemplate="{{$template}}"
    :objoptions="{{json_encode($options)}}"
    :objtypes="{{json_encode($types)}}"
    url="{{url('/admin_api/templates')}}"
    action="post"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Create New Template
                </h3>
            </div>
            <div>
                <a :href="'/templates/'"
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
                @include('templates.form')
            </div>
        </div>
    </div>
</div> 
</templates-form>
@endsection
