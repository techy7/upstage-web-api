@extends('layouts.metronic.profile.profile')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="pubprofile-header px-5 pt-5 text-center"> 
                <h3 class="text-capitalize">{{$listing->name}}</h3>
                <p class="m-0">By <a href="{{url('/user/'.$profile->slug)}}">{{$profile->full_name }}</a></p>
                <p class="text-muted m-0">{{$listing->description}}</p> 
            </div>
             

            <div class="m-content">
                <div class="">
                    @if($listing->items->count()) 
                    <div class="row justify-content-center">
                        @foreach($listing->items as $item)
                            <div class="col-md-4">
                                <a href="#" data-toggle="modal" data-target="#itemModal{{$item->hash}}" 
                                    class="listing-box m-portlet p-3 d-block"
                                > 
                                    <div class="listing-wrap">
                                        @if(strpos($item->mimetype, 'image') !== false) 
                                            <img src='{{url("/image/items/300/300/".$item->filename)}}' class="w-100">  
                                        @else 
                                            <img src='/img/video.png' class="w-100" alt="...">  
                                        @endif
                                        <span class="listing-name text-white p-1 w-100 d-block">
                                            {{$item->label}}
                                        </span>
                                    </div>
                                </a>
                            </div> 
                        @endforeach
                    </div>
                    @else
                        <div class="m-portlet p-5 text-center">
                            No listing items found
                        </div>
                    @endif
                </div>
            </div>    

            @if($listing->items->count()) 
            @foreach($listing->items as $item)
            <div class="modal fade" 
                id="itemModal{{$item->hash}}" 
                tabindex="-1" 
                aria-labelledby="itemModal{{$item->hash}}Label" 
                aria-hidden="true"
                data-videoid="videoModal{{$item->hash}}" 
            >
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="itemModal{{$item->hash}}Label">
                                {{$item->label}}
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body p-0">
                            @if(strpos($item->mimetype, 'image') !== false) 
                                <img src="{{url('/image/items/'.$item->filename)}}" class="w-100" />
                            @endif

                            @if(strpos($item->mimetype, 'video') !== false) 
                                <video controls width="250" class="w-100 video-item-player" id="videoModal{{$item->hash}}" >

                                    <source src="{{url('/video/items/'.$item->filename.'/watch')}}"
                                            type="{{$item->mimetype}}"> 

                                    Sorry, your browser doesn't support embedded videos.
                                </video>
                            @endif
                        </div> 
                        @if($item->description)
                        <div class="p-4">{{$item->description}}</div>
                        @endif
                    </div>
                </div>
            </div>   
            @endforeach
            @endif 
        </div>
    </div>
    
</div> 

@endsection
