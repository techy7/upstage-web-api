<div class="card-header">
  <h4 class="m-0">Media Assets</h4>
</div>


<div class="card-body">

    <p>
      <i class="fa fa-exclamation-triangle text-danger"></i>
      Note: This is used to be the <strong class="text-danger">Layers</strong> which is available only for <strong class="text-danger">Virtual Staging</strong> type. But now it applies to all types - photo, video, virtual_staging</p>
    <div class="accordion" id="accordionLayerAPIs">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingLayerIndex">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left btn-block" type="button" data-toggle="collapse" data-target="#collapseLayerIndex" aria-expanded="false" aria-controls="collapseLayerIndex">
              All Media Assets
            </button>
          </h2>
        </div>

        <div id="collapseLayerIndex" class="collapse" aria-labelledby="headingLayerIndex" data-parent="#accordionLayerAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/projects/{project_hash}/rooms/{presentation_hash}/media-assets</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Returns the list of available media assets for that room.</p>
              <p class="m-0">A room of type <strong>virtual_staging</strong> can have multiple <strong>media assets</strong> images as a reference for the Editor</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <p>None</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
<h4 class="m0">Example Response: Success</h4> 
<pre class="text-danger mb-5">
[
    {
        "mimetype": "image/png",
        "filename": "layer_sofa.png",
        "hash": "k0ex6e5m",
        "presentation_hash": "30x2wrxy",
        "project_hash": "9q1jn0p3",
        "file_url": "http://upstage.test/image/media_assets/layer_sofa.png",
        "thumbnail_url": "http://upstage.test/image/media_assets/150/150/layer_sofa.png"
    },
    {
        "mimetype": "image/jpeg",
        "filename": "layer_cabinet.jpeg",
        "hash": "pdzj340v",
        "presentation_hash": "30x2wrxy",
        "project_hash": "9q1jn0p3",
        "file_url": "http://upstage.test/image/media_assets/layer_cabinet.jpeg",
        "thumbnail_url": "http://upstage.test/image/media_assets/150/150/layer_cabinet.jpeg"
    }
]
</pre>  
            </div>

            <div class="mb-5">
<h4 class="m0">Example Response: Error</h4> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  
            </div>
          </div>
        </div>
      </div>
      <div class="card">
        <div class="card-header px-2 py-1" id="headingLayerCreate">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseLayerCreate" aria-expanded="false" aria-controls="collapseLayerCreate">
              Create New Media Asset
            </button>
          </h2>
        </div>
        <div id="collapseLayerCreate" class="collapse" aria-labelledby="headingLayerCreate" data-parent="#accordionLayerAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_URL/api/projects/{project_hash}/rooms/{presentation_hash}/media-assets</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for adding new media asset of a presentation.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <table class="table table-bordered table-hover font12">
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Required</th>
                    <th>Description</th>
                    <th>Default Value</th>
                    <th>Example</th>
                  </tr>
                </thead>
                <tbody> 
                  <tr> 
                    <td>file</td>
                    <td>required</td>
                    <td>File Image</td>
                    <td></td>
                    <td></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "mimetype": "image/jpeg",
    "filename": "layer_table.jpeg",
    "hash": "7o48lzj0",
    "presentation_hash": "30x2wrxy",
    "project_hash": "9q1jn0p3",
    "file_url": "http://upstage.test/image/media_assets/layer_table.jpeg",
    "thumbnail_url": "http://upstage.test/image/media_assets/150/150/layer_table.jpeg"
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not add new media assets.",
    "errors": {
        "file": [
            "The file field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre>  
            </div>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-header px-2 py-1" id="headingLayerShow">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseLayerShow" aria-expanded="false" aria-controls="collapseLayerShow">
              Display Media Asset
            </button>
          </h2>
        </div>
        <div id="collapseLayerShow" class="collapse" aria-labelledby="headingLayerShow" data-parent="#accordionLayerAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_URL/api/projects/{project_hash}/rooms/{presentation_hash}/media-assets/{media_asset_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for retrieving a media asset info.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <p>None</p>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "mimetype": "image/jpeg",
    "filename": "layer_bed.jpeg",
    "hash": "7o48lzj0",
    "presentation_hash": "30x2wrxy",
    "project_hash": "9q1jn0p3",
    "file_url": "http://upstage.test/image/layers/layer_bed.jpeg",
    "thumbnail_url": "http://upstage.test/image/layers/150/150/layer_bed.jpeg"
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  
            </div>
          </div>
        </div>
      </div>


      <div class="card">
        <div class="card-header px-2 py-1" id="headingLayerDelete">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseLayerDelete" aria-expanded="false" aria-controls="collapseLayerDelete">
              Delete Media Asset
            </button>
          </h2>
        </div>
        <div id="collapseLayerDelete" class="collapse" aria-labelledby="headingLayerDelete" data-parent="#accordionLayerAPIs">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">DELETE base_URL/api/projects/{project_hash}/rooms/{presentation_hash}/media-assets/{media_asset_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p>Endpoint for deleting media asset where {media_asset_hash} is the HASH of the media asset that you want to delete.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <p>None</p>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Media Asset was successfully deleted",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "error": "Unauthorized",
    "status_code": 401
}
</pre>  
            </div>
          </div>
        </div>
      </div>
       
    </div>
</div>