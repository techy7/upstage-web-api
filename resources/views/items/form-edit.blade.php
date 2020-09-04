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
                                value="{{$listing->user->name}} ({{$listing->user->email}})"
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
                            Label
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

                    <div class="col-md-12 mb-3">
                        <label class='clearfix d-block'>
                            Image / Video
                        </label>
                        <input type='file' 
                            class='form-control' 
                            :class="{'is-invalid': errors.file}"
                            @change='updateFile($event, "file_upload_item", "file")' 
                            id='file_upload_item'
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
                            >Submit</button>
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
                                        Image File
                                    </label>
                                    <img src="{{url('/image/items/'.$item->filename)}}" class="w-100" />
                                @endif

                                @if(strpos($item->mimetype, 'video') !== false)
                                    <label class='clearfix d-block'> 
                                        Video File
                                    </label>
                                    <video controls width="250" class="w-100">

                                        <source src="{{url('/video/items/'.$item->filename.'/watch')}}"
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
    </div>
</div>
        