@extends('layouts.metronic.classic.app')

@section('content')
<div>
    <!-- BEGIN: Subheader -->
    <div class="m-subheader">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    <i class="flaticon-interface-8"></i> Dashboard
                </h3>
            </div>
             
        </div>
    </div>
    <!-- END: Subheader -->

    <div class="m-content">
        <div class="row mb-5">
            <div class="col-md-12 col-lg-6 mb-3"> 
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="row m-row--no-padding m-row--col-separator-xl">
                           <div class="col-md-12">
                              <!--begin::Total Profit-->
                              <div class="m-widget24">
                                 <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                       New Users
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
                                        Registered This Week 
                                    </span>
                                    <span class="m-widget24__stats m--font-brand">
                                        {{number_format($newUsers)}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm mt-3 mb-3">
                                       <div class="progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> 
                                    <span class="m-widget24__change">
                                        All Users
                                    </span>
                                    <span class="m-widget24__number">
                                        {{number_format($allUsers)}}
                                    </span>
                                 </div>
                              </div>
                              <!--end::Total Profit-->
                           </div>
                            
                        </div>
                    </div>
                </div> 
            </div>

            <div class="col-md-12 col-lg-6 mb-3"> 
                <div class="m-portlet"> 
                    <div class="m-portlet__body m-portlet__body--no-padding">
                        <div class="row m-row--no-padding m-row--col-separator-xl"> 
                           <div class="col-md-12 ">
                              <!--begin::New Feedbacks-->
                              <div class="m-widget24">
                                 <div class="m-widget24__item">
                                    <h4 class="m-widget24__title">
                                       New Listings
                                    </h4>
                                    <br>
                                    <span class="m-widget24__desc">
                                        Created This Week 
                                    </span>
                                    <span class="m-widget24__stats m--font-danger">
                                        {{number_format($newListings)}}
                                    </span>
                                    <div class="m--space-10"></div>
                                    <div class="progress m-progress--sm mt-3 mb-3">
                                       <div class="progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> 
                                    <span class="m-widget24__change">
                                        All Listings
                                    </span>
                                    <span class="m-widget24__number">
                                        {{number_format($allListings)}}
                                    </span>
                                 </div>
                              </div>
                              <!--end::New Feedbacks-->
                           </div>
                            
                        </div>
                    </div>
                </div> 
            </div>
        </div>

        <div class="row"> 
            <div class="col-lg-6">
                <!--begin:: Widgets/New Users-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    New Users
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--brand m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" href="{{url('users')}}" >
                                    View All User
                                    </a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <!--begin::Widget 14 Item-->
                            @if($latestUsers->count())
                                @foreach($latestUsers as $user)
                                    <div class="m-widget4__item">  
                                        @if($user->avatar)
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <img src="{{url('/image/avatars/100/100/'.$user->avatar)}}" />
                                            </div>
                                        @else
                                            <div class="m-widget4__img m-widget4__img--pic">
                                                <img src="/img/user1.png" alt="">
                                            </div>
                                        @endif

                                        <div class="m-widget4__info"> 
                                            <span class="m-widget4__title">
                                                {{$user->full_name}}
                                            </span>
                                            <br>
                                            <span class="m-widget4__sub">
                                                {{$user->email}}
                                            </span>
                                        </div>
                                        <div class="m-widget4__ext">
                                            <a href="{{url('/users/'.$user->hash)}}" class="m-btn m-btn--pill m-btn--hover-brand btn btn-sm btn-secondary">
                                            View
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-5 text-center">No new users</div>
                            @endif
                            <!--end::Widget 14 Item--> 
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/New Users-->
            </div>
            <div class="col-lg-6">
                <!--begin:: Widgets/New Users-->
                <div class="m-portlet m-portlet--full-height ">
                    <div class="m-portlet__head">
                        <div class="m-portlet__head-caption">
                            <div class="m-portlet__head-title">
                                <h3 class="m-portlet__head-text">
                                    New Listings
                                </h3>
                            </div>
                        </div>
                        <div class="m-portlet__head-tools">
                            <ul class="nav nav-pills nav-pills--danger m-nav-pills--align-right m-nav-pills--btn-pill m-nav-pills--btn-sm" role="tablist">
                                <li class="nav-item m-tabs__item">
                                    <a class="nav-link m-tabs__link active" href="{{url('listings')}}" >
                                    View All Listings
                                    </a>
                                </li> 
                            </ul>
                        </div>
                    </div>
                    <div class="m-portlet__body">
                        <div class="m-widget4">
                            <!--begin::Widget 14 Item-->
                            @if($latestListings->count())
                                @foreach($latestListings as $list)
                                    <div class="m-widget4__item"> 
                                        <div class="m-widget4__info pl-0">
                                            <span class="m-widget4__title">
                                                {{$list->name}}
                                            </span>
                                            <br>
                                            <span class="m-widget4__sub">
                                                {{$list->user->full_name}}
                                            </span>
                                        </div>
                                        <div class="m-widget4__ext">
                                            <a href="{{url('/listings/'.$list->hash)}}" class="m-btn m-btn--pill m-btn--hover-danger btn btn-sm btn-secondary">
                                            View
                                            </a>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-5 text-center">No new listings</div>
                            @endif
                            <!--end::Widget 14 Item--> 
                        </div>
                    </div>
                </div>
                <!--end:: Widgets/New Users-->
            </div>
        </div>
    </div>


</div> 



 
@endsection
