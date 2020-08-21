@extends('layouts.app')

@section('content')
<items-form 
    :objitem="{{$item}}"
    url="{{url('/admin_api/listings/'.$listing->hash.'/items/'.$item->hash)}}" 
    redirect_url="{{url('/listings/'.$listing->hash)}}"
    action="put"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a href="{{url('/listings/'.$listing->hash)}}" 
                                class="btn-sm btn btn-secondary"
                            >Back</a> 
                        </div>
                        Edit Item
                    </div>

                    <div class="card-body">
                        @include('items.form-edit')
                    </div>
                </div>
            </div>
        </div>
    </div>
</items-form>
@endsection
