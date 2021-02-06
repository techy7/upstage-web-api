<div class="row">
    <div class="col-lg-6">
        <div class="m-portlet"> 
            <div class="m-portlet__body">
                <div class="row">
                     
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class='clearfix d-block'> 
                                User
                            </label>
                            <input type='text' 
                                class='form-control' 
                                disabled 
                                value="{{$listing->user->full_name}} ({{$listing->user->email}})"
                            >
                        </div>
                        <div class="mb-3">
                            <label class='clearfix d-block'> 
                                Listing 
                            </label>
                            <input type='text' 
                                class='form-control' 
                                disabled 
                                value="[{{$listing->hash}}] {{$listing->name}}"
                            >
                        </div>
                    </div>
                    
                    <div class="col-md-12 mb-3">
                        <label class='clearfix d-block'>
                            <small class='float-right'>* required</small>
                            Name
                        </label>
                        <input type='text' 
                            v-model='item.label' 
                            class='form-control' 
                            :class="{'is-invalid': errors.label}"
                        >
                        <small v-cloak 
                            class='text-danger' 
                            v-if='errors.label' 
                            v-for='err in errors.label'
                        >@{{err}}</small>
                    </div>

                    <div class="col-md-12 mb-3"> 
                        <label class='clearfix d-block'>
                            Description
                        </label>
                        <textarea v-model='item.description' 
                            class='form-control' 
                            :class="{'is-invalid': errors.description}" 
                            rows="3"
                        ></textarea>
                        <small v-cloak 
                            class='text-danger' 
                            v-if='errors.description' 
                            v-for='err in errors.description'
                        >@{{err}}</small>
                    </div> 

                    @if($item->template)
                    <div class="col-md-12 mb-3">
                        <label class='clearfix d-block'>
                            <small> 
                                <a class='float-right' href="{{url('/templates/'.$item->template->hash)}}" target="_new">
                                    view template
                                </a>
                            </small>
                            Template
                        </label>
                        <input type='text' 
                            value="{{$item->template->name}}" 
                            class='form-control' 
                            disabled 
                        > 
                    </div>
                    @endif

                    <div class="col-md-12 mb-3">
                        <label class='clearfix d-block'>
                            Image / Video
                        </label>
                        <input type='file' 
                            class='form-control' 
                            :class="{'is-invalid': errors.file}"
                            @change='updateFile($event, "file_upload_item", "file")' 
                            id='file_upload_item'
                            accept="image/*, video/*"
                        >
                        <small v-cloak 
                            class='text-danger' 
                            v-if='errors.file' 
                            v-for='err in errors.file'
                        >@{{err}}</small>
                    </div>

                    <div class="col-md-12 pt-3">
                        <div v-cloak v-if="msgError" class="alert alert-danger">
                            @{{msgError}}
                        </div>
                        <div v-cloak v-if="msgSuccess" class="alert alert-success">
                            @{{msgSuccess}}
                        </div>

                        <p class="text-center">
                            <button class="btn btn-primary" 
                                :disabled="isLoading" 
                                @click="submitItem"
                            >
                                <span v-if="isLoading"><i class="fa fa-cog fa-spin"></i> Submitting...</span>
                                <span v-else>Submit</span>
                            </button>
                        </p>
                    </div>          
                </div>
            </div>
        </div> 
    </div>
    <div class="col-lg-6">
        <div class="m-portlet"> 
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12"> 
                                @if(strpos($item->mimetype, 'image') !== false)
                                    <label class='clearfix d-block'> 
                                        Original Image File
                                        @if($item->layers->count())
                                            <small class="float-right text-primary">
                                                Added media assets below
                                            </small>
                                        @else
                                            <small class="float-right text-muted">
                                                No media assets
                                            </small>
                                        @endif
                                    </label>
                                    <img src="{{url('/image/presentations/'.$item->filename)}}" class="w-100" />
                                @endif

                                @if(strpos($item->mimetype, 'video') !== false)
                                    <label class='clearfix d-block'> 
                                        Original Video File

                                        @if($item->layers->count())
                                            <small class="float-right text-primary">
                                                Added media assets below
                                            </small>
                                        @else
                                            <small class="float-right text-muted">
                                                No media assets
                                            </small>
                                        @endif
                                    </label>
                                    <video controls width="250" class="w-100">

                                        <source src="{{url('/video/presentations/'.$item->filename.'/watch')}}"
                                                type="{{$item->mimetype}}"> 

                                        Sorry, your browser doesn't support embedded videos.
                                    </video>
                                @endif
                            </div>   
                                  
                        </div> 
                    </div> 
                </div>
            </div>
        </div> 

        <div class="m-portlet"> 
            <div class="m-portlet__body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12"> 
                                <label class='clearfix d-block'> 
                                    <strong>Media Assets</strong>
                                </label>

                                @if($item->layers->count())
                                <div class="row">  
                                    @foreach($item->layers as $asset)
                                        <div class="col-md-3">
                                            @if(strpos($asset->mimetype, 'image') !== false) 
                                                <img src="{{url('/image/media_assets/'.$asset->filename)}}" class="w-100" />
                                            @endif

                                            @if(strpos($asset->mimetype, 'video') !== false) 
                                                <video controls width="250" class="w-100">

                                                    <source src="{{url('/video/media_assets/'.$asset->filename.'/watch')}}"
                                                            type="{{$asset->mimetype}}"> 

                                                    Sorry, your browser doesn't support embedded videos.
                                                </video>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                                @else
                                    <p>No added media assets</p>
                                @endif
                            </div>   
                        </div> 
                    </div> 
                </div>
            </div>
        </div> 
    </div>
</div>
        