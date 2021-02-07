<div class="card-header">
  <h4 class="m-0 clearfix">
    Chats API
  </h4>
</div>


<div class="card-body">
    
    <div class="accordion" id="accordionChat">
      <div class="card">
        <div class="card-header px-2 py-1" id="headingChat">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseChat" aria-expanded="false" aria-controls="collapseChat">
              All Chats
            </button>
          </h2>
        </div>
        <div id="collapseChat" class="collapse" aria-labelledby="headingChat" data-parent="#accordionChat">
          <div class="card-body">
            <div class="mb-5">
              <h4 class="m0">Resource URL</h4>
              <p class="text-primary">GET base_URL/api/chats</p> 
            </div>

            <div class="mb-5">
              <h4 class="m0">Description</h4>
              <p class="m-0">Get the user's chats. Each presentation has chat attached when created. This endpoint requires the <strong>TOKEN</strong> acquired in login.</p>
              <p>Chats are sorted by <strong class="text-danger">created_at</strong> field in <strong class="text-danger">descending</strong> order</p> 
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
                    <td>Integer to indicate the page nnumber. Default chats per page is 20</td>
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
          "user_status": "new",
          "hash": "q6rqoz94",
          "created_at": "2021-02-06T11:25:37.000000Z",
          "updated_at": "2021-02-07T02:56:47.000000Z",
          "last_message": {
              "body": "last message here",
              "sender": "editor"
          },
          "presentation": {
              "name": "kamote ntemplate 5",
              "description": "photo with layers fix",
              "status": "pending",
              "type": "photo",
              "instruction": "this is just a basic instruction",
              "hash": "7dlrz1x4",
              "slug": "kamote-ntemplate-5-7dlrz1x4",
              "created_at": "2021-02-06T11:25:37.000000Z",
              "updated_at": "2021-02-06T11:25:37.000000Z",
              "file": {
                  "filename": "621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png",
                  "mimetype": "image/png",
                  "file_url": "http://upstage.test/image/presentations/621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png",
                  "thumbnail_url": "http://upstage.test/image/presentations/150/150/621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png"
              },
              "media_assets_count": 2
          },
          "project": {
              "name": "kamote1",
              "hash": "621wyzg9",
              "slug": "kamote1-621wyzg9"
          }
      },
      {
        ....
      }
    ],
    "first_page_url": "http://upstage.test/api/chats?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://upstage.test/api/chats?page=1",
    "next_page_url": null,
    "path": "http://upstage.test/api/chats",
    "per_page": 20,
    "prev_page_url": null,
    "to": 4,
    "total": 4
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
        <div class="card-header px-2 py-1" id="headingChatShow">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseChatShow" aria-expanded="false" aria-controls="collapseChatShow">
              Display Chat Info
            </button>
          </h2>
        </div>
        <div id="collapseChatShow" class="collapse" aria-labelledby="headingChatShow" data-parent="#accordionChat">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">GET base_url/api/chats/{chat_hash}</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">This only gives you the chat info, chat messages are fetched in separate query</p>

               
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
    "user_status": "new",
    "hash": "q6rqoz94",
    "created_at": "2021-02-06T11:25:37.000000Z",
    "updated_at": "2021-02-07T02:42:35.000000Z",
    "presentation": {
        "name": "kamote ntemplate 5",
        "description": "photo with layers fix",
        "status": "pending",
        "type": "photo",
        "instruction": "this is just a basic instruction",
        "hash": "7dlrz1x4",
        "slug": "kamote-ntemplate-5-7dlrz1x4",
        "created_at": "2021-02-06T11:25:37.000000Z",
        "updated_at": "2021-02-06T11:25:37.000000Z",
        "file": {
            "filename": "621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png",
            "mimetype": "image/png",
            "file_url": "http://upstage.test/image/presentations/621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png",
            "thumbnail_url": "http://upstage.test/image/presentations/150/150/621wyzg91612610737_file_screencapture-zapier-app-editor-110674882-nodes-110674883-fields-2021-01-20-23-27-39png.png"
        },
        "media_assets_count": 2
    },
    "project": {
        "name": "kamote1",
        "hash": "621wyzg9",
        "slug": "kamote1-621wyzg9"
    }
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
        <div class="card-header px-2 py-1" id="headingChatMessages">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseChatMessages" aria-expanded="false" aria-controls="collapseChatMessages">
              Chat Messages
            </button>
          </h2>
        </div>
        <div id="collapseChatMessages" class="collapse" aria-labelledby="headingChatMessages" data-parent="#accordionChat">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">GET base_url/api/chats/{chat_hash}/messages</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Chat messages are paginated so it's separated from it's parent Chat Info request</p>  
              <p>Everytime this is called, the <strong class="text-danger">user_status</strong> is set to <strong class="text-danger">seen</strong></p>
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
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
                    <td>Integer to indicate the page nnumber. Default chats per page is 20</td>
                    <td></td>
                    <td>1</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "current_page": 1,
    "data": [
        {
            "sender": "editor",
            "hash": "m7e2zoer",
            "body": "asdasd",
            "created_at": "2021-02-07T02:43:51.000000Z",
            "updated_at": "2021-02-07T02:43:51.000000Z",
            "date": "Feb 07, 2021 02:43 am"
        },
        {
            "sender": "editor",
            "hash": "o24z9rem",
            "body": "asdasd",
            "created_at": "2021-02-07T02:42:35.000000Z",
            "updated_at": "2021-02-07T02:42:35.000000Z",
            "date": "Feb 07, 2021 02:42 am"
        },
        {
            "sender": "user",
            "hash": "35epjoej",
            "body": "seen and new to editor",
            "created_at": "2021-02-07T02:39:53.000000Z",
            "updated_at": "2021-02-07T02:39:53.000000Z",
            "date": "Feb 07, 2021 02:39 am"
        }, 
        {
          ...
        }
    ],
    "first_page_url": "http://upstage.test/api/chats/q6rqoz94/messages?page=1",
    "from": 1,
    "last_page": 2,
    "last_page_url": "http://upstage.test/api/chats/q6rqoz94/messages?page=2",
    "next_page_url": "http://upstage.test/api/chats/q6rqoz94/messages?page=2",
    "path": "http://upstage.test/api/chats/q6rqoz94/messages",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 40
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
        <div class="card-header px-2 py-1" id="headingChatMessageSend">
          <h2 class="mb-0">
            <button class="btn btn-link btn-block text-left collapsed" type="button" data-toggle="collapse" data-target="#collapseChatMessageSend" aria-expanded="false" aria-controls="collapseChatMessageSend">
              Send Chat Message
            </button>
          </h2>
        </div>
        <div id="collapseChatMessageSend" class="collapse" aria-labelledby="headingChatMessageSend" data-parent="#accordionChat">
          <div class="card-body">
            <div class="mb-5">
              <h5 class="m0">Resource URL</h5>
              <p class="text-primary">POST base_url/api/chats/{chat_hash}/messages</p> 
            </div>

            <div class="mb-5">
              <h5 class="m0">Description</h5>
              <p class="mb-1">Send a chat message</p>   
            </div>

            <div class="mb-5">
              <h4 class="m0">Headers</h4>
              <p>Authorization : Bearer {token}</p>
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
                    <td>body</td>
                    <td>required</td>
                    <td>String. the message</td>
                    <td></td>
                    <td>Hello there</td>
                  </tr>
                </tbody>
              </table>
            </div>

            <div class="mb-5">
<h5 class="m0">Example Response : Success</h5> 
<pre class="text-danger mb-5">
{
    "body": "seen and new to editor",
    "hash": "38480vew",
    "sender": "user",
    "updated_at": "2021-02-07T03:09:58.000000Z",
    "created_at": "2021-02-07T03:09:58.000000Z",
    "date": "Feb 07, 2021 03:09 am"
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