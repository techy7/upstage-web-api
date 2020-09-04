@extends('layouts.metronic.classic.app')

@section('content')
<users-show 
    :objuser="{{$user}}"
    inline-template
>

<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-users"></i> User Details
                </h3>
            </div>
            <div>
                <a :href="'/users/'" 
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-dark">Back</span>
                        <span class="btn btn-dark m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-angle-left m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 

                <a :href="'/users/'+user.hash+'/edit'"
                    class="btn m-btn--pill btn-secondary btn--icon m-btn--pill py-2 pr-2"
                >
                    <span> 
                        <span class="m--font-info">Edit</span>
                        <span class="btn btn-info m-btn m-btn--icon btn-sm m-btn--icon-only  m-btn--pill ml-1">
                            <i class="la la-pencil-square m--font-light m--font-light"></i>
                        </span> 
                    </span>
                </a> 
                <a :href="'/users/'+user.hash+'/delete'" 
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
                                        <h3 class="m-widget1__title" v-html='user.full_name || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div>

                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Email
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='user.email || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div> 
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Contact Number
                                        </span> 
                                        <h3 class="m-widget1__title" v-html='user.contact_num || "n/a"'></h3> 
                                    </div> 
                                </div>
                            </div> 
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col">
                                        <span class="m-widget1__desc">
                                            Plan
                                        </span> 
                                        <h3 class="m-widget1__title" v-cloak v-if="user.plan">@{{user.plan.name}}</h3> 
                                        <h3 class="m-widget1__title" v-else>n/a</h3> 
                                    </div> 
                                </div>
                            </div> 
                            <div class="m-widget1__item">
                                <div class="row m-row--no-padding align-items-center">
                                    <div class="col-6">
                                        <span class="m-widget1__desc d-block">
                                            Avatar
                                        </span> 
                                        <p v-if='user.avatar' class="d-inline-block">
                                            <img :src="'/image/avatars/100/100/'+user.avatar" width='100' />
                                        </p>
                                        <p v-else class="d-inline-block">
                                            <img src='/img/photo.png' width='100' />
                                        </p> 
                                    </div> 
                                    <div class="col-6" v-if='user.fb_avatar'>
                                        <span class="m-widget1__desc d-block">
                                            Facebook Avatar
                                        </span>  
                                        <p>
                                            <img :src="user.fb_avatar" width='100' />
                                        </p> 
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
</users-show>
@endsection
