@extends('layouts.metronic.classic.app')

@section('content')
<items-delete 
    :objitem="{{$item}}"
    listing_hash="{{$listing->hash}}"
    redirect_url="{{url('/projects/'.$listing->hash)}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Delete Item
                </h3>
            </div>
            <div>
                <a href="{{url('/projects/'.$listing->hash)}}" 
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
                <div class="m-portlet"> 
                    <div class="m-portlet__body">
                        <div class="m-alert m-alert--icon alert alert-danger mb0" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-danger"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong class="block">
                                    Delete "@{{item.label}}"?
                                </strong>
                                <br>
                                You cannot retrieve this data after deleting.
                            </div>
                            <div class="m-alert__actions" style="width: 220px;">
                                <button v-if="!isLoading"  @click="deleteItem" type="button" 
                                    class="btn btn-secondary btn-sm m-btn m-btn--hover-danger" 
                                    data-dismiss="alert1" aria-label="Close"
                                >
                                    Yes, delete!
                                </button>

                                <button v-else disabled type="button" class="btn btn-outline-light btn-sm m-btn m-btn--hover-brand m-loader m-loader--light m-loader--right" data-dismiss="alert1" aria-label="Close">
                                    Deleting...
                                </button>
                            </div>
                        </div>
                        <div v-cloak v-if="msgSuccess" class="alert alert-success text-center">
                            <p class="mb-0">@{{msgSuccess}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
</items-delete>
@endsection
