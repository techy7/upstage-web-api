<div class="card-header">
  <h4 class="m-0">Rooms/Gallery API</h4>
</div>


<div class="card-body">
    <div class="accordion" id="accordionListingItem">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingItemAll">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseItemAll" aria-expanded="false" aria-controls="collapseItemAll">
              All Rooms
            </button>
          </h2>
        </div>
        <div id="collapseItemAll" class="collapse" aria-labelledby="headingItemAll" data-parent="#accordionListingItem">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/listings/{listing_hash}/rooms</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Returns the rooms/gallery of the given listing_hash. This endpoint requires the <strong>TOKEN</strong> acquired in login.</p>
              <p class="m-0">The <strong class="text-primary">data</strong> in response is where the rooms and the others are for pagination like <strong class="text-primary">current_page</strong>, <strong class="text-primary">total</strong></p>
              <p>You can also get rooms/gallery in the listing object <strong class="text-primary">listing.rooms</strong>. Refer to the <strong>Display Listing</strong> section</p>
              <p class="m-0">
                There are 2 types of item: 
                <strong class="text-primary">image</strong> and 
                <strong class="text-primary">video</strong>. 
                You can use the 
                <strong class="text-primary">file.mimetype</strong>
                to check its type.
              </p>
              <p class="m-0">
                For images, there is given <strong class="text-primary">file.thumbnail_url</strong> for thumbnail but feel free to change the width and height (/150/150/) in the URL to match the size that you need. 
              </p>
              <p class="m-0">
                This is done by assembling <strong>baseurl/image/rooms</strong> + <strong>/{width}/{heigth}/</strong> + <strong>{file.filename}</strong>
              </p>
              <p class="m-0"><span class="text-danger">No thumbnail for video yet</span></p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Parameters</h4>
              <p>None</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">URL Query Strings</h4>
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
                    <td>q</td>
                    <td>optional</td>
                    <td>Any string to search</td>
                    <td></td>
                    <td>Mansion</td>
                  </tr>
                  <tr> 
                    <td>page</td>
                    <td>optional</td>
                    <td>Integer to indicate the page number. Default rooms per page is 20</td>
                    <td></td>
                    <td>Mansion</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
<h4 class="m0">Example Response: Success</h4> 
<pre class="text-danger mb-5">
{
    "current_page": 1,
    "data": [
      {
        "name": "move",
        "description": "monv",
        "status": "raw",
        "type": "photo",
        "instruction": "this is just a basic instruction",
        "hash": "6qlw4xmy",
        "slug": "move-6qlw4xmy",
        "layers_count" => 3,
        "created_at": "2020-08-21T15:21:40.000000Z",
        "updated_at": "2020-08-21T15:21:40.000000Z",
        "file": {
          "filename": "videofile.mp4",
          "mimetype": "video/mp4",
          "file_url": "http://localhost/video/rooms/videofile.mp4",
          "thumbnail_url": null
        },
        "listing": {
            "name": "Alice had been to the end of the court. (As that is.",
            "hash": "m806w1pg",
            "slug": "alice-had-been-to-the-end-of-the-court-as-that-is-m806w1pg"
        }
      },
      {
          "name": "item 2",
          "description": "this is item 2",
          "type": "photo",
          "instruction": "this is just a basic instruction",
          "status": "raw",
          "hash": "9do1kxm5",
          "slug": "item-2-9do1kxm5",
          "layers_count" => 3,
          "created_at": "2020-08-21T15:03:50.000000Z",
          "updated_at": "2020-08-21T15:03:50.000000Z",
          "file": {
              "filename": "house_image.png",
              "mimetype": "image/png",
              "file_url": "http://localhost/image/rooms/house_image.png",
              "thumbnail_url": "http://localhost/image/rooms/150/150/house_image.png"
          },
          "listing": {
              "name": "Alice had been to the end of the court. (As that is.",
              "hash": "m806w1pg",
              "slug": "alice-had-been-to-the-end-of-the-court-as-that-is-m806w1pg"
          }
      },
      ....
    ],
    "first_page_url": "http://localhost:8000/api/listings/5nzqox1l/rooms?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://localhost:8000/api/listings/5nzqox1l/rooms?page=2",
    "next_page_url": "http://localhost:8000/api/listings/5nzqox1l/rooms?page=2",
    "path": "http://localhost:8000/api/listings/5nzqox1l/rooms",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 24
}
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
        <div class="card-header px-2 py-1" id="headingItemNew">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseItemNew" aria-expanded="false" aria-controls="collapseItemNew">
              Create New Room
            </button>
          </h2>
        </div>
        <div id="collapseItemNew" class="collapse" aria-labelledby="headingItemNew" data-parent="#accordionListingItem">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/listings/{listing_hash}/rooms</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for adding new room/gallery on a given listing</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
              <h5 class="m0">Parameters</h5>
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
                    <td>name</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>Front Gate</td>
                  </tr>
                  <tr> 
                    <td>description</td>
                    <td>optional</td>
                    <td>Additional text that describe the listing</td>
                    <td></td>
                    <td>A big house on the beach</td>
                  </tr> 
                  <tr> 
                    <td>file</td>
                    <td>required</td>
                    <td>An image or video file</td>
                    <td></td>
                    <td></td>
                  </tr>
                  <tr> 
                    <td>type</td>
                    <td>required</td>
                    <td>
                      Select one of the following <strong>media_type</strong>: 
                      <strong>photo</strong>,
                      <strong>video</strong>,
                      <strong>virtual_staging</strong>
                    </td>
                    <td></td>
                    <td>A big house on the beach</td>
                  </tr> 
                  <tr> 
                    <td>layers[]</td>
                    <td>required if virtual_staging</td>
                    <td>An array of images for Layers which is required if <strong>media_type</strong> is <strong>virtual_staging</strong></td>
                    <td></td>
                    <td></td>
                  </tr> 
                  <tr> 
                    <td>instruction</td>
                    <td>optional</td>
                    <td>Special instructions</td>
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
    "name": "Front Gate",
    "description": "this is front gate",
    "status": "raw",
    "hash": "9zxqwx6j",
    "slug": "front-gate-9zxqwx6j",
    "created_at": "2020-08-22T18:19:06.000000Z",
    "updated_at": "2020-08-22T18:19:06.000000Z",
    "file": {
        "filename": "frontgate.png",
        "mimetype": "image/png",
        "file_url": "http://localhost/image/rooms/frontgate.png",
        "thumbnail_url": "http://localhost/image/rooms/150/150/frontgate.png"
    },
    "layers": [
        {
            "mimetype": "image/png",
            "filename": "30x2wrxy1603638172_file_layer_one_photo.png",
            "hash": "5r4ox4pw",
            "file_url": "http://upstage.test/image/layers/150/150/30x2wrxy1603638172_file_layer_one_photo.png"
        }
    ]

}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not add new listing.",
    "errors": {
        "name": [
            "The name field is required."
        ],
        "file": [
            "The file field is required."
        ],
        "type": [
            "Virtual Staging staging type requires at least 1 layer photo"
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger">
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
        <div class="card-header px-2 py-1" id="headingItemShow">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseItemShow" aria-expanded="false" aria-controls="collapseItemShow">
              Display Room
            </button>
          </h2>
        </div>
        <div id="collapseItemShow" class="collapse" aria-labelledby="headingItemShow" data-parent="#accordionListingItem">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/listings{listing_hash}/room/{item_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for retrieving item details where <strong class="text-primary">{listing_hash}</strong> is the HASH of the listing and <strong class="text-primary">{item_hash}</strong> is the HASH of item that you want to view.</p>
              
              <p class="m-0">
                There are 2 types of item: 
                <strong class="text-primary">image</strong> and 
                <strong class="text-primary">video</strong>. 
                You can use the 
                <strong class="text-primary">file.mimetype</strong>
                to check its type.
              </p>
              <p class="m-0">
                For images, there is given <strong class="text-primary">file.thumbnail_url</strong> for thumbnail but feel free to change the width and height (/150/150/) in the URL to match the size that you need. 
              </p>
              <p class="m-0">
                This is done by assembling <strong>baseurl/image/room/</strong> + <strong>/{width}/{heigth}/</strong> + <strong>{file.filename}</strong>
              </p>
              <p class="m-0">Add <strong class="text-primary">/watch</strong> at the end of video URL if you want the streamable video (<small class="text-muted">http://localhost/video/room/video_item.mp4/watch</small>)</p>
              <p class="m-0"><span class="text-danger">No thumbnail for video yet</span></p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
              <h5 class="m0">Parameters</h5>
              <p>None</p>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "name": "item 2",
    "description": "this is item 2",
    "type": "photo",
    "instruction": "this is just a basic instruction",
    "status": "raw",
    "hash": "9do1kxm5",
    "slug": "item-2-9do1kxm5",
    "created_at": "2020-08-21T15:03:50.000000Z",
    "updated_at": "2020-08-21T15:03:50.000000Z",
    "file": {
        "filename": "item_image.png",
        "mimetype": "image/png",
        "file_url": "http://localhost/image/rooms/item_image.png",
        "thumbnail_url": "http://localhost/image/rooms/150/150/item_image.png"
    },
    "listing": {
        "name": "Alice had been to the end of the court. (As that is.",
        "hash": "m806w1pg",
        "slug": "alice-had-been-to-the-end-of-the-court-as-that-is-m806w1pg"
    },
    "layers": [
        {
            "mimetype": "image/png",
            "filename": "30x2wrxy1603638172_file_layer_one_photo.png",
            "hash": "5r4ox4pw",
            "file_url": "http://upstage.test/image/layers/150/150/30x2wrxy1603638172_file_layer_one_photo.png"
        }
    ]
}
</pre> 

<h5 class="m0">Example Response : Success Video</h5> 
<pre class="text-danger mb-5">
{
    "name": "video item",
    "description": "this is a video item",
    "type": "video",
    "instruction": "this is just a basic instruction",
    "status": "raw",
    "hash": "6qlw4xmy",
    "slug": "video-item-6qlw4xmy",
    "created_at": "2020-08-21T15:21:40.000000Z",
    "updated_at": "2020-08-21T15:21:40.000000Z",
    "file": {
        "filename": "video_item.mp4",
        "mimetype": "video/mp4",
        "file_url": "http://localhost/video/rooms/video_item.mp4",
        "thumbnail_url": null
    },
    "listing": {
        "name": "Alice had been to the end of the court. (As that is.",
        "hash": "m806w1pg",
        "slug": "alice-had-been-to-the-end-of-the-court-as-that-is-m806w1pg"
    }
},
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger">
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
        <div class="card-header px-2 py-1" id="headingItemEdit">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseItemEdit" aria-expanded="false" aria-controls="collapseItemEdit">
              Edit Room
            </button>
          </h2>
        </div>
        <div id="collapseItemEdit" class="collapse" aria-labelledby="headingItemEdit" data-parent="#accordionListingItem">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/listings/{listing_hash}/rooms/{item_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for updating item details where <strong class="text-primary">{listing_hash}</strong> is the HASH of the parent listing and <strong class="text-primary">{item_hash}</strong> is the HASH of item that you want to update.</p>
              <p>If success, it will return the updated item object</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
              <h5 class="m0">Parameters</h5>
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
                    <td>name</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>Front Gate</td>
                  </tr>
                  <tr> 
                    <td>description</td>
                    <td>optional</td>
                    <td>Additional text that describe the listing</td>
                    <td></td>
                    <td>A big house on the beach</td>
                  </tr>  
                  <tr> 
                    <td>instruction</td>
                    <td>optional</td>
                    <td>Special instructions</td>
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
    "name": "test edit",
    "description": saving updated description,
    "type": "video",
    "instruction": "this is just a basic instruction",
    "status": "raw",
    "hash": "mrlyko46",
    "slug": "tttt-mrlyko46",
    "created_at": "2020-08-21T16:09:31.000000Z",
    "updated_at": "2020-08-21T16:12:04.000000Z",
    "file": {
        "filename": "item_image.png",
        "mimetype": "image/png",
        "file_url": "http://localhost/image/rooms/item_image.png",
        "thumbnail_url": "http://localhost/image/rooms/150/150/item_image.png"
    },
    "layers": [
        {
            "mimetype": "image/png",
            "filename": "30x2wrxy1603638172_file_layer_one_photo.png",
            "hash": "5r4ox4pw",
            "file_url": "http://upstage.test/image/layers/150/150/30x2wrxy1603638172_file_layer_one_photo.png"
        }
    ]
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not update listing.",
    "errors": {
        "name": [
            "The name field is required."
        ]
    },
    "status": "error",
    "status_code": 422
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger">
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
        <div class="card-header px-2 py-1" id="headingItemDelete">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseItemDelete" aria-expanded="false" aria-controls="collapseItemDelete">
              Delete Room
            </button>
          </h2>
        </div>
        <div id="collapseItemDelete" class="collapse" aria-labelledby="headingItemDelete" data-parent="#accordionListingItem">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">DELETE base_url/api/listings/{listing_hash}/rooms/{item_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for deleting item where <strong class="text-primary">{item_hash}</strong> is the HASH of the item that you want to delete. This also requires the hash of parent listing.</p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
            </div>

            <div class="mb-5">
              <h5 class="m0">Parameters</h5>
              <p>None</p>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "message": "Item was successfully deleted",
    "status_code": 200
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger">
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