@extends('layouts.metronic.classic.app')

@section('content')
<editors-show 
    :objeditor="{{$editor}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-editors"></i> Editor Details
                </h3>
            </div>
            <div>
                <a :href="'/editors/'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/editors/'+editor.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/editors/'+editor.hash+'/delete'" 
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
                                            Full Name:
                                        </span> 
                                        <h3 class="m-widget1__title" v-if='editor.full_name'>
                                            @{{editor.full_name}} 
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
                                            Email
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='editor.email || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div> 
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Contact Number
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='editor.contact_num || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>  
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col-6">
                                        <span class="m-widget1__desc d-block">
                                            Avatar
                                        </span> 
                                        <p v-if='editor.avatar' class="d-inline-block">
                                            <img :src="'/image/avatars/100/100/'+editor.avatar" width='100' />
                                        </p>
                                        <p v-else class="d-inline-block">
                                            <img src='/img/photo.png' width='100' />
                                        </p> 
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
                                        Assigned Listings
                                    </span>
                                </h2> 
                            </div>
                        </div> 
                    </div>
                    <div class="m-portlet__body">
                        @if($editor->listedits->count()) 
                            <div class="m-widget4" >
                            @foreach($editor->listedits as $list)
                                <div class="m-widget4__item"> 
                                    <div class="m-widget4__img m-widget4__img">
                                        @if($list->first_item)
                                            <img src="{{url('/image/items/100/100/'.$list->first_item->filename)}}" class="w-50" />
                                        @else
                                            <img src='/img/photo.png' class="w-50" alt="...">
                                        @endif
                                    </div>
                                    <div class="m-widget4__info">
                                        <span class="m-widget4__title">
                                            {{$list->name}}
                                        </span>
                                        <br class="">
                                        <span class="m-widget4__sub ">
                                            {{$list->user->full_name}}
                                        </span>
                                    </div> 

                                    <span class="m-widget4__ext w-150 d-inline-block text-right">
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="Download " href="{{url('/listings/'.$list->hash)}}" target="_blank"> 
                                            <i class="la la-external-link-square"></i>
                                        </a>   
                                    </span>
                                </div> 
                            @endforeach
                            </div>  
                        @else
                            <div class="p-5 text-center">No assigned listings found for this editor</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
 
</div>
</editors-show>
@endsection
