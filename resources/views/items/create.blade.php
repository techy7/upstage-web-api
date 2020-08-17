@extends('layouts.app')

@section('content')
<items-form 
    :objitem="{{$item}}"
    url="{{url('/admin_api/listings/g298k9wx/items')}}"
    redirect_url="{{url('/listings/g298k9wx')}}"
    action="post"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/listings/g298k9wx/'" class="btn-sm btn btn-secondary">Back</a> 
                        </div>
                        Add New item
                    </div>

                    <div class="card-body">
                        @include('items.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</items-form>
@endsection
