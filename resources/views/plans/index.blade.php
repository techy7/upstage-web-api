@extends('layouts.metronic.classic.app')

@section('content')
<plans-list inline-template>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-map-location"></i> Plans
                </h3>
            </div>
            <div>
                <a href="{{url('plans/new')}}" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-primary">Add</span>
                        <span class="btn btn-primary m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-plus m--font-light m--font-light"></i>
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
                <div class="m-portlet" v-cloak>
                    <div class="m-portlet__head"> 
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    All plans
                                    <small>@{{plans.total}} plans found</small>
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <form @submit.prevent="getList(1)" class="m-input-icon m-input-icon--right m-0">
                                        <input type="text" 
                                            class="form-control m-input" 
                                            v-model="filters.q" 
                                            placeholder="Type keywords here..."
                                        >
                                        <span class="m-input-icon__icon m-input-icon__icon--right" 
                                            @click="getList(1)"
                                        >
                                            <span>
                                                <i class="flaticon-search-1"></i>
                                            </span>
                                        </span>
                                    </form>
                                </li>
                            </ul> 
                        </div>
                    </div>
                    <div class="m-portlet__body py-0">
                        <div class="m-widget4" v-cloak v-if="plans.total">
                            <div class="m-widget4__item" v-for="(plan, index) in plans.data"> 
                                <div class="m-widget4__info pl-0">
                                    <span class="m-widget4__title">
                                        @{{plan.name}}
                                    </span>
                                    <br class="">
                                    <span class="m-widget4__sub ">
                                        Plan Name
                                    </span>
                                </div> 
                                <span class="m-widget4__info">
                                    <span class="d-inline-block w-150 text-center"> 
                                        <span class="m-widget4__title">
                                            @{{plan.limit_list}} Lists / @{{plan.limit_space}} MB
                                        </span>
                                        <br class="">
                                        <span class="m-widget4__sub ">
                                            Limit 
                                        </span>
                                    </span> 
                                </span>
                                <span class="m-widget4__info">
                                    <span class="d-inline-block w-150 text-center"> 
                                        <span class="m-widget4__title">
                                            $@{{plan.price}}
                                        </span>
                                        <br class="">
                                        <span class="m-widget4__sub ">
                                            Price 
                                        </span>
                                    </span> 
                                </span>
                                <span class="m-widget4__ext">
                                    <span class="d-inline-block w-150 text-right"> 
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="View " :href="'/plans/'+plan.hash"> 
                                            <i class="la la-external-link-square"></i>
                                        </a> 
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Edit " :href="'/plans/'+plan.hash+'/edit'"> 
                                            <i class="la la-pencil-square"></i>
                                        </a>  
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" :href="'/plans/'+plan.hash+'/delete'"> 
                                            <i class="la la-trash"></i>
                                        </a>   
                                    </span> 
                                </span>
                            </div> 
                        </div>

                        <div v-cloak class="text-center p-5" v-if="!plans.total && !isLoading"> 
                                There are no plans found.  
                        </div> 

                        <div class="text-center p-5" v-if="!plans.total && isLoading"> 
                                loading... 
                        </div> 
                    </div>
                    <div class="m-portlet__foot">
                        <pagination :data="plans" @pagination-change-page="getPage"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



    
</plans-list>
@endsection
