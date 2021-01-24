@extends('layouts.metronic.classic.app')

@section('content')
<items-show 
    :objitem="{{$item}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Presentation Details
                </h3>
            </div>
            <div>
                 <a :href="'/projects/'+item.listing.hash"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/presentations/'+item.listing.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/presentations/'+item.hash+'/delete'" 
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
            <div class="col-md-12 col-lg-12">
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-widget1"> 

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Presentation Name:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='item.label || "n/a"'></h3> 
                                    </div> 

                                    <div class="col">
                                        <div class="row">
                                            <div class="col-6">
                                                <span class="m-widget1__desc">
                                                    Status: 
                                                </span> 
                                                <h3 class="m-widget1__title">
                                                    @{{item.status}}  
                                                </h3> 
                                            </div>
                                            <div class="col-6"> 
                                                <!-- :href="'/projects/'+item.listing.hash+'/presentations/'+item.hash+'/process'" -->
                                                <button 
                                                    v-if="item.status == 'pending'" @click="setStatus('processing')"
                                                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 float-right"
                                                >
                                                    <span> 
                                                        <span class="m--font-primary">Set to Processing</span>
                                                        <span class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                                                            <i class="la la-external-link-square m--font-light m--font-light"></i>
                                                        </span> 
                                                    </span>
                                                </button>  

                                                <button 
                                                    v-else-if="item.status == 'processing'" @click="setStatus('done')"
                                                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 float-right"
                                                >
                                                    <span> 
                                                        <span class="m--font-success">Set to Done</span>
                                                        <span class="btn btn-success m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                                                            <i class="la la-external-link-square m--font-light m--font-light"></i>
                                                        </span> 
                                                    </span>
                                                </button> 

                                                <button 
                                                    v-else-if="item.status == 'done'" 
                                                    disabled 
                                                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 float-right"
                                                >
                                                    <span> 
                                                        <span class="m--font-success">Done</span> 
                                                    </span>
                                                </button>  
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Project Name:
                                        </span> 
                                        <h3 class="m-widget1__title">
                                            @{{item.listing.name}}
                                            <small class="text-muted font-size-12">
                                                <a href="{{url('/projects/'.$item->listing->hash)}}" target="_new">
                                                    <i class="la la-external-link-square"></i>
                                                </a>
                                            </small>
                                        </h3> 
                                    </div> 

                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Template: 
                                        </span> 
                                        <h3 class="m-widget1__title" v-if="item.template">
                                            @{{item.template.name}}
                                            <small class="text-muted font-size-12">
                                                <a href="{{url('/templates/'.$item->template->hash)}}" target="_new">
                                                    <i class="la la-external-link-square"></i>
                                                </a>
                                            </small>
                                        </h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Description:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='item.description || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Instruction:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='item.instruction || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-md-12 col-lg-6">
                <div class="m-portlet"> 
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        @if(strpos($item->mimetype, 'image') !== false)
                                            <label class='clearfix d-block'> 
                                                Original Image File
                                                @if($item->layers->count())
                                                    <small class="float-right text-primary">
                                                        Added media assets below
                                                    </small>
                                                @else
                                                    <small class="float-right text-muted">
                                                        No media assets
                                                    </small>
                                                @endif
                                            </label>
                                            <img src="{{url('/image/presentations/'.$item->filename)}}" class="w-100" />
                                        @endif

                                        @if(strpos($item->mimetype, 'video') !== false)
                                            <label class='clearfix d-block'> 
                                                Original Video File

                                                @if($item->layers->count())
                                                    <small class="float-right text-primary">
                                                        Added media assets below
                                                    </small>
                                                @else
                                                    <small class="float-right text-muted">
                                                        No media assets
                                                    </small>
                                                @endif
                                            </label>
                                            <video controls width="250" class="w-100">

                                                <source src="{{url('/video/presentations/'.$item->filename.'/watch')}}"
                                                        type="{{$item->mimetype}}"> 

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

            <div class="col-md-12 col-lg-6">
                <div class="m-portlet"> 
                    <div class="m-portlet__body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12"> 
                                        <label class='clearfix d-block'> 
                                            <strong>Media Assets</strong>
                                        </label>

                                        @if($item->layers->count())
                                        <div class="row">  
                                            @foreach($item->layers as $asset)
                                                <div class="col-md-6">
                                                    @if(strpos($asset->mimetype, 'image') !== false) 
                                                        <img src="{{url('/image/media_assets/'.$asset->filename)}}" class="w-100" />
                                                    @endif

                                                    @if(strpos($asset->mimetype, 'video') !== false) 
                                                        <video controls width="250" class="w-100">

                                                            <source src="{{url('/video/media_assets/'.$asset->filename.'/watch')}}"
                                                                    type="{{$asset->mimetype}}"> 

                                                            Sorry, your browser doesn't support embedded videos.
                                                        </video>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        @else
                                            <p>No added media assets</p>
                                        @endif
                                    </div>   
                                </div> 
                            </div> 
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

    
</items-show>
@endsection
