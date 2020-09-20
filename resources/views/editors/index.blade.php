@extends('layouts.metronic.classic.app')

@section('content')
<editors-list inline-template>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-editors"></i> Editors
                </h3>
            </div>
            <div>
                <a href="{{url('editors/new')}}" 
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
                                    All editors
                                    <small>@{{editors.total}} editors found</small>
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="m-portlet__nav">
                                <li class="m-portlet__nav-item">
                                    <select class="form-control" v-model="filters.sort" @change="getList(1)">
                                        <option value="first_name">Sort by Name</option>
                                        <option value="listedits_count">Sort by List</option>
                                    </select>
                                </li>
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
                        <div class="m-widget4" v-cloak v-if="editors.total">
                            <div class="m-widget4__item" v-for="(editor, index) in editors.data"> 
                                <div class="m-widget4__info pl-0">
                                    <span class="m-widget4__title">
                                        @{{editor.full_name}}
                                    </span>
                                    <br class="">
                                    <span class="m-widget4__sub ">
                                        @{{editor.email}}
                                    </span>
                                </div>  
                                <span class="m-widget4__info md-none sm-none">
                                    <span class="d-inline-block w-150 text-center"> 
                                        <span class="m-widget4__title">
                                            @{{editor.listedits_count}}
                                        </span>
                                        <br class="">
                                        <span class="m-widget4__sub ">
                                            Listings
                                        </span>
                                    </span> 
                                </span>
                                <span class="m-widget4__ext">
                                    <span class="d-inline-block w-150 text-right">  
                                        <a class="m-portlet__nav-link m--font-success btn m-btn m-btn--hover-focus m-btn--icon m-btn--icon-only m-btn--pill" title="View " :href="'/editors/'+editor.hash"> 
                                            <i class="la la-file"></i>
                                        </a> 
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-info m-btn--icon m-btn--icon-only m-btn--pill" title="Edit " :href="'/editors/'+editor.hash+'/edit'"> 
                                            <i class="la la-pencil-square"></i>
                                        </a>  
                                        <a class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Delete" :href="'/editors/'+editor.hash+'/delete'"> 
                                            <i class="la la-trash"></i>
                                        </a>   
                                    </span> 
                                </span>
                            </div> 
                        </div>

                        <div v-cloak class="text-center p-5" v-if="!editors.total && !isLoading"> 
                                There are no editors found.  
                        </div> 

                        <div class="text-center p-5" v-if="!editors.total && isLoading"> 
                                loading... 
                        </div> 
                    </div>
                    <div class="m-portlet__foot">
                        <pagination :data="editors" @pagination-change-page="getPage"></pagination>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

    
</editors-list>
@endsection
