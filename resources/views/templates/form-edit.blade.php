<div class="row">
    <div class="col-lg-8"> 
        <div class="m-portlet"> 
            <div class="m-portlet__body">
                
                <p>
                    <label class='clearfix d-block'>
                        <small class='float-right'>* required</small>
                        Template Name
                    </label>
                    <input type='text' v-model='template.name' class='form-control' :class="{'is-invalid': errors.name}">
                    <small v-cloak class='text-danger' v-if='errors.name' v-for='err in errors.name'>@{{err}}</small>
                </p>

                <p>
                    <label class='clearfix d-block'> 
                        Description
                    </label>
                    <textarea rows="5" v-model='template.description'  class="form-control" :class="{'is-invalid': errors.description}"></textarea> 
                    <small v-cloak class='text-danger' v-if='errors.description' v-for='err in errors.description'>@{{err}}</small>
                </p>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class='clearfix d-block'> 
                            Type
                        </label>
                        <select v-model="template.type" class="form-control" 
                            :class="{'is-invalid': errors.type}"
                            @change="filterCatsByType"
                        >
                            <option value="">Select a Type</option>
                            @foreach($types as $type)
                            <option value="{{$type}}">{{$type}}</option>
                            @endforeach 
                        </select>
                        <small v-cloak class='text-danger' v-if='errors.type' v-for='err in errors.type'>@{{err}}</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class='clearfix d-block'> 
                            Category
                        </label>
                        <select v-model="template.category" class="form-control" :class="{'is-invalid': errors.category}">
                            <option value="">Select a Category</option>
                            <option v-for="(option, index) in catOptions" :value="option">@{{option}}</option> 
                        </select>
                        <small v-cloak class='text-danger' v-if='errors.category' v-for='err in errors.category'>@{{err}}</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class='clearfix d-block'>
                            <small class='float-right'>* required</small>
                            Image / Video
                        </label>
                        <input type='file' 
                            class='form-control' 
                            :class="{'is-invalid': errors.media}"
                            @change='updateFile($event, "file_upload_item", "media")' 
                            id='file_upload_item'
                            accept="image/*, video/*"
                        >
                        <small v-cloak 
                            class='text-danger' 
                            v-if='errors.media' 
                            v-for='err in errors.media'
                        >@{{err}}</small>
                    </div>
                </div>
            </div>
        </div>

        <div v-cloak v-if="msgError" class="alert alert-danger">
            @{{msgError}}
        </div>
        <div v-cloak v-if="msgSuccess" class="alert alert-success">
            @{{msgSuccess}}
        </div>

        <p class="text-center">
            <button class="btn btn-primary" 
                :disabled="isLoading" 
                @click="submitTemplate"
            >
                <span v-if="isLoading"><i class="fa fa-cog fa-spin"></i> Submitting...</span>
                <span v-else>Submit</span>
            </button>
        </p>
    </div>
    <div class="col-lg-4">
        <div class="m-portlet"> 
            <div class="m-portlet__body m-portlet__body--no-padding">
                <div class="m-widget1">  

                    @if(strpos($template->mimetype, 'image') !== false)
                        <label class='clearfix d-block'> 
                            Image File
                        </label>
                        <img src="{{url('/image/templates/'.$template->filename)}}" class="w-100" />
                    @endif

                    @if(strpos($template->mimetype, 'video') !== false)
                        <label class='clearfix d-block'> 
                            Video File
                        </label>
                        <video controls width="250" class="w-100">

                            <source src="{{url('/video/templates/'.$template->filename.'/watch')}}"
                                    type="{{$template->mimetype}}"> 

                            Sorry, your browser doesn't support embedded videos.
                        </video>
                    @endif
                </div>
            </div>
        </div> 
    </div>
</div>