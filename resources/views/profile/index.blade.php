@extends('layouts.metronic.profile.profile', [
    'title' => ucwords($profile->full_name),
    'desc' => $profile->description,
    'linkurl' => url('/user/'.$profile->slug),
    'imgurl' => $profile->avatar ? url("/image/avatars/500/500/".$profile->avatar) : null
])

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pubprofile-header px-5 pt-5 text-center">
                @if($profile->avatar)
                    <img src='{{url("/image/avatars/300/300/".$profile->avatar)}}' class=" mb-4" alt="...">
                @else
                    <img src='/img/profile-xs.png' class=" mb-4" alt="...">
                @endif
                <h3>{{$profile->full_name}}</h3>
                <p>{{$profile->description}}</p>
            </div>
             

            <div class="m-content">
                <div class="">
                    @if($profile->listings->count()) 
                        <div class="row justify-content-center">
                            @foreach($profile->listings as $list)
                                <div class="col-md-4">
                                    <a href="{{url('user/'.$profile->slug.'/'.$list->hash)}}" 
                                        class="listing-box m-portlet p-3 d-block"
                                    >
                                        <div class="listing-wrap">
                                            @if($list->first_item)
                                                @if($list->first_item->editedItem)
                                                    <img src='{{url("/image/editedpresentations/300/300/".$list->first_item->editedItem->filename)}}' 
                                                        class="w-100" 
                                                        alt="..."
                                                    >
                                                @else
                                                    <img src='{{url("/image/presentations/300/300/".$list->first_item->filename)}}' 
                                                        class="w-100" 
                                                        alt="..."
                                                    >
                                                @endif
                                            @else
                                                <img src='/img/default.png' class="w-100" alt="...">
                                            @endif
                                            <span class="listing-name text-white p-1 d-block w-100">
                                                {{$list->name}}
                                            </span>
                                        </div>
                                    </a>
                                </div> 
                            @endforeach
                        </div>
                    @else 
                        <div class="m-portlet p-5 text-center">
                            No listings found
                        </div>
                    @endif
                </div>
            </div>       
        </div>
    </div>
    
</div> 

@endsection
