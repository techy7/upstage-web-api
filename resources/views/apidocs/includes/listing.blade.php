<div class="card-header">
  <h4 class="m-0 clearfix">
    Projects API
  </h4>
</div>


<div class="card-body">
    <p><i class="fa fa-exclamation-triangle text-danger"></i> Note: this is the old <strong class="text-danger">Listing</strong> module</p>
    <div class="accordion" id="accordionListing">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingListing">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseListing" aria-expanded="false" aria-controls="collapseListing">
              All Projects
            </button>
          </h2>
        </div>
        <div id="collapseListing" class="collapse" aria-labelledby="headingListing" data-parent="#accordionListing">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/projects</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Returns the loggedin user's projects. This endpoint requires the <strong>TOKEN</strong> acquired in login.</p>
              <p>The <strong class="text-primary">data</strong> in response is where the projects and the others are for pagination like <strong class="text-primary">current_page</strong>, <strong class="text-primary">total</strong></p>

              <ul>
                <li>
                  <strong>num_of_presentations</strong> is the limit of presentations to be added.
                </li>
                <li>
                  <strong>presentations_count</strong> is the current number of uploaded presentations
                </li>
              </ul>
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
                    <td>Integer to indicate the page nnumber. Default projects per page is 20</td>
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
          "name": "Project One",
          "description": "This is project 1",
          "address": "Brooklyn 99",
          "state": "New York",
          "num_of_presentations": 9,
          "status": "pending", 
          "presentations_count": 4,
          "hash": "vdzpnl17",
          "first_presentation": {...},
          "presentations": {...},
          "user": {...}
          ....
      },
      {
          "name": "Project Two",
          "description": "This is project 2",
          "address": "Brooklyn 99",
          "state": "New York",
          "num_of_presentations": 9,
          "status": "pending", 
          "presentations_count": 4,
          "hash": "vdzpnl18",
          "first_presentation": {...},
          "presentations": {...},
          "user": {...}
          ....
      },
    ],
    "first_page_url": "http://localhost:8000/api/projects?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://localhost:8000/api/projects?page=2",
    "next_page_url": "http://localhost:8000/api/projects?page=2",
    "path": "http://localhost:8000/api/projects",
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
        <div class="card-header px-2 py-1" id="headingListingNew">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseListingNew" aria-expanded="false" aria-controls="collapseListingNew">
              Create New Project
            </button>
          </h2>
        </div>
        <div id="collapseListingNew" class="collapse" aria-labelledby="headingListingNew" data-parent="#accordionListing">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/projects</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for creating new project</p>
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
                    <td>Beach House</td>
                  </tr>
                  <tr> 
                    <td>description</td>
                    <td>optional</td>
                    <td>Additional text that describe the project</td>
                    <td></td>
                    <td>A big house on the beach</td>
                  </tr> 
                  <tr> 
                    <td>address</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>Brooklyn 99</td>
                  </tr>
                  <tr> 
                    <td>state</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>New York</td>
                  </tr> 
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "name": "Beach House",
    "description": "Big house near the beach",
    "address": "Brooklyn 99",
    "state": "New York", 
    "hash": "xy08g71j",
    "slug": "beach-house-xy08g71j",
    "created_at": "2020-08-20T14:23:54.000000Z",
    "updated_at": "2020-08-20T14:23:54.000000Z",
    "user": {
        "name": "User1 One",
        "hash": "4n5qn"
    }
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not add new project",
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
    "message": "Reached maximum number of projects for your plan",
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
        <div class="card-header px-2 py-1" id="headingListingShow">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseListingShow" aria-expanded="false" aria-controls="collapseListingShow">
              Display Project
            </button>
          </h2>
        </div>
        <div id="collapseListingShow" class="collapse" aria-labelledby="headingListingShow" data-parent="#accordionListing">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/projects/{project_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for retrieving project details where <strong class="text-primary">{project_hash}</strong> is the HASH of the project that you want to view.</p>
              <p>This also includes <strong class="text-primary">presentations/gallery</strong> of the projects. Refer to Presentations section of this doc for more item/gallery info</p>

              <ul> 
                <li>
                  <strong>presentations_count</strong> is the current number of uploaded presentations
                </li>
              </ul>
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
    "name": "Beach House",
    "description": "Big house near the beach",
    "address": "Brooklyn 99",
    "state": "New York", 
    "hash": "xy08g71j",
    "slug": "beach-house-xy08g71j",
    "created_at": "2020-08-20T14:23:54.000000Z",
    "updated_at": "2020-08-20T14:23:54.000000Z",
    "user": {
      "name": "User1 One",
      "hash": "4n5qn"
    },
    "presentations": [
      {
        "name": "item1",
        .....
      }
    ]
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
        <div class="card-header px-2 py-1" id="headingListingEdit">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseListingEdit" aria-expanded="false" aria-controls="collapseListingEdit">
              Edit Project
            </button>
          </h2>
        </div>
        <div id="collapseListingEdit" class="collapse" aria-labelledby="headingListingEdit" data-parent="#accordionListing">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/projects/{project_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for updating project where <strong class="text-primary">{project_hash}</strong> is the HASH of the project that you want to update.</p>
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
                    <td>Beach House</td>
                  </tr>
                  <tr> 
                    <td>description</td>
                    <td>optional</td>
                    <td>Additional text that describe the project</td>
                    <td></td>
                    <td>A big house on the beach</td>
                  </tr> 
                  <tr> 
                    <td>address</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>Brooklyn 99</td>
                  </tr>
                  <tr> 
                    <td>state</td>
                    <td>required</td>
                    <td>String</td>
                    <td></td>
                    <td>New York</td>
                  </tr>
                  <tr> 
                    <td>num_of_presentations</td>
                    <td>required</td>
                    <td>Number of presentations between <strong>1</strong> to <strong>10</strong></td>
                    <td></td>
                    <td>5</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "name": "Beach House",
    "description": "Big house near the beach",
    "address": "Brooklyn 99",
    "state": "New York",
    "num_of_presentations": 9,
    "hash": "xy08g71j",
    "slug": "beach-house-xy08g71j",
    "created_at": "2020-08-20T14:23:54.000000Z",
    "updated_at": "2020-08-20T14:23:54.000000Z",
    "user": {
        "name": "User1 One",
        "hash": "4n5qn"
    }
}
</pre> 

<h5 class="m0">Example Response : Error</h5> 
<pre class="text-danger mb-5">
{
    "message": "Could not update project.",
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
        <div class="card-header px-2 py-1" id="headingListingDelete">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseListingDelete" aria-expanded="false" aria-controls="collapseListingDelete">
              Delete Project
            </button>
          </h2>
        </div>
        <div id="collapseListingDelete" class="collapse" aria-labelledby="headingListingDelete" data-parent="#accordionListing">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">DELETE base_url/api/projects/{project_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Endpoint for deleting project where <strong class="text-primary">{project_hash}</strong> is the HASH of the project that you want to delete.</p>
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
    "message": "Project was successfully deleted",
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