@extends('layouts.app')

@section('content')
<listings-form 
    :objlisting="{{$listing}}"
    url="{{url('/admin_api/listings')}}"
    action="post"
    inline-template
>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header clearfix">
                        <div class="float-right ml-1" role="group">
                            <a :href="'/listings/'" class="btn-sm btn btn-secondary">Back</a> 
                        </div>
                        Add New listing
                    </div>

                    <div class="card-body">
                        @include('listings.form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</listings-form>
@endsection
