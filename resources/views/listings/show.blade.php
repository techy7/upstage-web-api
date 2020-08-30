@extends('layouts.metronic.classic.app')

@section('content')
<listings-show 
    :objlisting="{{$listing}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-squares-1"></i> Listing Details
                </h3>
            </div>
            <div>
                <a :href="'/listings/'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/listings/'+listing.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/listings/'+listing.hash+'/delete'" 
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
            <div class="col-md-12">
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="m-widget1"> 

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Listing Name:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.name || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Description:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.description || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Status:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.status || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            User: 
                                        </span>
                                        <h3 class="m-widget1__title" v-if='listing.user'>
                                            @{{listing.user.full_name}}
                                            <small>(@{{listing.user.email}}) </small>
                                        </h3>  
                                        <h3 class="m-widget1__title" v-else>
                                            n/a
                                        </h3>  
                                        
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Editor:
                                        </span> 
                                        <h3 class="m-widget1__title" v-if='listing.editor'>
                                            @{{listing.editor.full_name}}
                                            <small>(@{{listing.editor.email}}) </small>
                                        </h3>  
                                        <h3 class="m-widget1__title" v-else>
                                            n/a
                                        </h3>  
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div> 

                <div class="m-portlet m-portlet--creative m-portlet--bordered-semi"> 
                    <div class="m-portlet__head h-0">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title"> 
                                <h2 class="m-portlet__head-label m-portlet__head-label--success">
                                    <span>
                                        Items
                                    </span>
                                </h2>
                                <div class="m-portlet--creative-buttons">
                                    <a :href="'/listings/'+listing.hash+'/items/new'"
                                        class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2 m-btn--air"
                                    >
                                        <span> 
                                            <span class="m--font-dark">Add New Item</span>
                                            <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                                                <i class="la la-plus m--font-light m--font-light"></i>
                                            </span> 
                                        </span>
                                    </a> 
                                </div> 
                            </div>
                        </div> 
                    </div>
                    <div class="m-portlet__body">
                        @if($listing->rawItems->count()) 
                            <div class="m-widget4" >
                            @foreach($listing->rawItems as $raw)
                                <div class="m-widget4__item"> 
                                    <div class="m-widget4__img m-widget4__img">
                                        @if(strpos($raw->mimetype, 'image') !== false)
                                            <img src="{{url('/image/items/100/100/'.$raw->filename)}}" class="w-50" />
                                        @else
                                            <img src='/img/photo.png' class="w-50" alt="...">
                                        @endif
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            {{$raw->label}}
                                        </span>
                                        <br class="">
                                        <span class="m-widget4__sub ">
                                            {{$raw->description}}
                                        </span>
                                    </div> 

                                    <span class="m-widget4__ext w-150 d-inline-block text-right">
                                        @if(strpos($raw->mimetype, 'image') !== false)
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="Download " href="{{url('/image/items/'.$raw->filename.'/download')}}" target="_blank"> 
                                            <i class="la la-download"></i>
                                        </a>  
                                        @else
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="Download " href="{{url('/video/items/'.$raw->filename.'/download')}}" target="_new"> 
                                            <i class="la la-download"></i>
                                        </a>  
                                        @endif
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Edit " href="{{url('listings/'.$listing->hash.'/items/'.$raw->hash.'/edit')}}"> 
                                            <i class="la la-pencil-square"></i>
                                        </a>  
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" href="{{url('listings/'.$listing->hash.'/items/'.$raw->hash.'/delete')}}"> 
                                            <i class="la la-trash"></i>
                                        </a>   
                                    </span>
                                </div> 
                            @endforeach
                            </div>  
                        @else
                            <div class="p-5 text-center">No items found in this listing</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
    
</listings-show>
@endsection
