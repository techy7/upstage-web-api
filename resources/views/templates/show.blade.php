@extends('layouts.metronic.classic.app')

@section('content')
<templates-show 
    :objtemplate="{{$template}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Template Details
                </h3>
            </div>
            <div>
                <a :href="'/templates/'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/templates/'+template.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/templates/'+template.hash+'/delete'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-danger">Delete</span>
                        <span class="btn btn-danger m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-trash m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a>  
            </div>
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-widget1"> 

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Template Name:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='template.name || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Template Category:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='template.category || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Template Type:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='template.type || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Template Description:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='template.description || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-lg-4">
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-widget1">  

                            @if(strpos($template->mimetype, 'image') !== false)
                                <label class='clearfix d-block'> 
                                    Image File
                                </label>
                                <img src="{{url('/image/templates/'.$template->filename)}}" class="w-100" />
                            @endif

                            @if(strpos($template->mimetype, 'video') !== false)
                                <label class='clearfix d-block'> 
                                    Video File
                                </label>
                                <video controls width="250" class="w-100">

                                    <source src="{{url('/video/templates/'.$template->filename.'/watch')}}"
                                            type="{{$template->mimetype}}"> 

                                    Sorry, your browser doesn't support embedded videos.
                                </video>
                            @endif
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

    
</templates-show>
@endsection
