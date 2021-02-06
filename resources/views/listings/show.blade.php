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
                    <i class="flaticon-squares-1"></i> Project Details
                </h3>
            </div>
            <div>
                <a :href="'/projects/'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/projects/'+listing.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/projects/'+listing.hash+'/delete'" 
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
                                            Project Name:
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
                                            Address:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.address || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            State:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.state || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Number of Rooms:
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='listing.num_of_rooms || "n/a"'></h3> 
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
                                    <div class="col" v-cloak>
                                        <span class="m-widget1__desc">
                                            User: 
                                        </span>
                                        <h3 class="m-widget1__title" v-cloak v-if='listing.user'>
                                            @{{listing.user.full_name}}
                                            <small v-cloak>(@{{listing.user.email}}) </small>
                                            <a :href="'/users/'+listing.user.hash">
                                                <i class="la la-external-link-square"></i>
                                            </a>
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
                                        Presentations
                                    </span>
                                </h2>
                                <div class="m-portlet--creative-buttons">
                                    {{--
                                    <a :href="'/projects/'+listing.hash+'/presentations/new'"
                                        class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2 m-btn--air"
                                    >
                                        <span> 
                                            <span class="m--font-dark">Add New Presentation</span>
                                            <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                                                <i class="la la-plus m--font-light m--font-light"></i>
                                            </span> 
                                        </span>
                                    </a> 
                                    --}}
                                </div> 
                            </div>
                        </div> 
                    </div>
                    <div class="m-portlet__body">
                        @if($listing->items->count()) 
                            <div class="m-widget4" >
                            @foreach($listing->items as $raw)
                                <div class="m-widget4__item"> 
                                    <div class="m-widget4__img m-widget4__img">
                                        @if($raw->editedItem) 
                                            @if(strpos($raw->editedItem->mimetype, 'image') !== false)
                                                <div class="editor-upload-box" 
                                                    @click="openEditorModal('{{url('/image/presentations/100/100/'.$raw->filename)}}', 'img', '{{$raw->hash}}')"
                                                >
                                                    <img src="{{url('/image/editedpresentations/100/100/'.$raw->editedItem->filename)}}" class="w-50" alt="...">
                                                    <i class="upicon la la-upload"></i>
                                                </div>
                                            @else
                                                <div class="editor-upload-box" 
                                                    @click="openEditorModal('{{url('/image/presentations/100/100/'.$raw->filename)}}', 'video', '{{$raw->hash}}')"
                                                >
                                                    <img src='/img/video.png' class="w-50" alt="...">
                                                    <i class="upicon la la-upload"></i>
                                                </div>
                                            @endif
                                        @else
                                            <div class="editor-upload-box" 
                                                @click="openEditorModal('{{url('/image/presentations/100/100/'.$raw->filename)}}', 'video', '{{$raw->hash}}')"
                                            >
                                                <img src='/img/uped.png' class="w-50" alt="...">
                                                <i class="upicon la la-upload"></i>
                                            </div>
                                        @endif
                                    </div> 
                                    <div class="m-widget4__img m-widget4__img">
                                        @if(strpos($raw->mimetype, 'image') !== false)
                                            <img src="{{url('/image/presentations/100/100/'.$raw->filename)}}" class="w-50" />
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
                                           <span> {{$raw->type}}</span>
                                           <span class="mx-10">&bull;</span>
                                           <span> {{$raw->status}}</span>
                                        </span>
                                    </div> 

                                    <span class="m-widget4__info">
                                        <span class="d-inline-block w-99 text-center"> 
                                            <span class="m-widget4__title">
                                                {{$raw->layers_count}}
                                            </span>
                                            <br class="">
                                            <span class="m-widget4__sub ">
                                                Media Assets 
                                            </span>
                                        </span> 
                                    </span>

                                    <span class="m-widget4__info">
                                        <span class="d-inline-block w-99 text-center"> 
                                            <span class="m-widget4__title">
                                                {{$raw->chat->messages_count ?? 0}}
                                            </span>
                                            <br class="">
                                            <span class="m-widget4__sub ">
                                                Chat 
                                            </span>
                                        </span> 
                                    </span>

                                    <span class="m-widget4__info">
                                        <span class="d-inline-block w-150 text-center text-truncate"> 
                                            <span class="m-widget4__title">
                                                {{$raw->template->name ?? 'N/A'}} asdsadadasda asdasd asdsad
                                            </span>
                                            <br class="">
                                            <span class="m-widget4__sub ">
                                                Template 
                                            </span>
                                        </span> 
                                    </span> 

                                    <span class="m-widget4__ext w-150 d-inline-block text-right">
                                        @if(strpos($raw->mimetype, 'image') !== false)
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="Download " href="{{url('/image/presentations/'.$raw->filename.'/download')}}" target="_blank"> 
                                            <i class="la la-download"></i>
                                        </a>  
                                        @else
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="Download " href="{{url('/video/rooms/'.$raw->filename.'/download')}}" target="_new"> 
                                            <i class="la la-download"></i>
                                        </a>  
                                        @endif
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Edit " href="{{url('projects/'.$listing->hash.'/presentations/'.$raw->hash)}}"> 
                                            <i class="la la-external-link-square"></i>
                                        </a>  
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" href="{{url('projects/'.$listing->hash.'/presentations/'.$raw->hash.'/delete')}}"> 
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

    <div class="modal fade" id="editorUploadModal" tabindex="-1" aria-labelledby="editorUploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editorUploadModalLabel">Upload Edited Version</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="editor-uploadform clearfix mb-3">
                        <img id='' :src='rawItem.url'  class='w-50 editor-uploadform-preview' />
                    
                        <div class='alert border clearfix mb-0'>
                            <button type="button" class="btn btn-primary float-right" 
                                :disabled="!editorImage && !editorVideo"
                                @click="submitEditorImage()"
                            >
                                <i class="la la-angle-right "></i>
                            </button>  
                            <input type='file' 
                                @change='addEditorImage($event, "img_upload_editor", "file")' 
                                v-if="uploadReady" ref="fileupload"
                                id='img_upload_editor'
                                class="float-left mt-2 w-200 ovh" 
                                accept="image/*, video/*"
                            > 
                        </div>
                    </div>

                    <img id='preview_img_upload_editor' src='/img/photo.png' v-if="editorImage" class='w-100' />
                    <div class="p-y text-center" v-if="editorVideo">No preview for this file type</div>
                </div> 
            </div>
        </div>
    </div>

</div>
    
</listings-show>
@endsection
