<div class="card-header">
  <h4 class="m-0 clearfix">
    Notifications API
  </h4>
</div>


<div class="card-body">
    
    <div class="accordion" id="accordionNotification">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingNotification">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseNotification" aria-expanded="false" aria-controls="collapseNotification">
              All Notifications
            </button>
          </h2>
        </div>
        <div id="collapseNotification" class="collapse" aria-labelledby="headingNotification" data-parent="#accordionNotification">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/notifications</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Returns available notifications for the user</p>
              <p>Notifications are sorted by <strong class="text-danger">status: new</strong> and descending <strong class="text-danger">created_at</strong></p>
              <p class="m-0">
                There are 3 types of notifications: <br> 
                <strong class="text-danger">presentation_done</strong>: when presentation was done <br>
                <strong class="text-danger">presentation_processing</strong>: when editor started working presentation <br>
                <strong class="text-danger">new_chat_message</strong>: when a new messages was sent by editor to user <br>
              </p>
              <p>Just mold your display message based on the notification types and available data for each type</p>
              <p>Notifications are set to <strong class="text-danger">seen</strong> if chats or presentations associated to the notification is opened or fetched</p>
               
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
                    <td>page</td>
                    <td>optional</td>
                    <td>Integer to indicate the page nnumber. Default notifications per page is 20</td>
                    <td></td>
                    <td>1</td>
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
            "type": "presentation_done",
            "status": "new",
            "data": {
                "project_hash": "621wyzg9",
                "project_name": "kamote1",
                "presentation_hash": "e8xdrror",
                "presentation_name": "tttt",
                "new_status": "done"
            },
            "created_at": "2021-02-08T08:30:11.000000Z"
        },
        {
            "type": "presentation_processing",
            "status": "new",
            "data": {
                "project_hash": "621wyzg9",
                "project_name": "kamote1",
                "presentation_hash": "e8xdrror",
                "presentation_name": "tttt",
                "new_status": "processing"
            },
            "created_at": "2021-02-08T08:30:00.000000Z"
        }, 
        {
            "type": "new_chat_message",
            "status": "new",
            "data": {
                "chat_hash": "q6rqoz94",
                "message_body": "addddddd",
                "message_hash": "kdn1wv4v",
                "project_hash": "621wyzg9",
                "project_name": "kamote1",
                "presentation_hash": "7dlrz1x4",
                "presentation_name": "kamote ntemplate 5"
            },
            "created_at": "2021-02-08T07:50:47.000000Z"
        }
    ],
    "first_page_url": "http://localhost:8000/api/notifications?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/notifications?page=1",
    "next_page_url": null,
    "path": "http://localhost:8000/api/notifications",
    "per_page": 20,
    "prev_page_url": null,
    "to": 11,
    "total": 11
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
       
       
       
    </div>
</div>