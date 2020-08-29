@extends('layouts.metronic.classic.app')

@section('content')
<plans-delete 
    :objplan="{{$plan}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-map-location"></i> Delete Plan
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
                <div class="m-portlet"> 
                    <div class="m-portlet__body">
                        <div class="m-alert m-alert--icon alert alert-danger mb0" role="alert">
                            <div class="m-alert__icon">
                                <i class="flaticon-danger"></i>
                            </div>
                            <div class="m-alert__text">
                                <strong class="block">
                                    Delete "@{{plan.name}}"?
                                </strong>
                                <br>
                                You cannot retrieve this data after deleting.
                            </div>
                            <div class="m-alert__actions" style="width: 220px;">
                                <button v-if="!isLoading"  @click="deletePlan" type="button" 
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</plans-delete>
@endsection
