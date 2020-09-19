Vue.component('listings-show', {
    props: ['objlisting'],

    data() {
        return {
            listing: {},
            isLoading: false,
            isUploading: false,
            objform : null,
            editorImage : false,
            editorVideo : false,
            rawItem: {
                type: null,
                url: null,
                hash: null
            },
            uploadReady: true
        }
    }, 

    mounted() {   
        this.listing = this.objlisting;
        this.objform = new FormData(); 

        $('#editorUploadModal').on('hidden.bs.modal', (e) => {
            this.objform = new FormData();
            this.rawItem.type = null;
            this.rawItem.url = null;
            this.rawItem.hash = null;
            this.editorImage = false;
            this.editorVideo = false;
            this.clearEditorInput();
        });

        $('#editorUploadModal').on('shown.bs.modal', (e) => {
            this.objform = new FormData(); 
            this.editorImage = false;
            this.editorVideo = false;
            this.clearEditorInput();
        });
    },  

    computed: {
        
    },

    methods: {  
        clearEditorInput () {
            this.uploadReady = false
            this.$nextTick(() => {
                this.uploadReady = true
            })
        },
        openEditorModal(url, type, hash){
            console.log(url, type, hash) 
            this.rawItem.url = url;
            this.rawItem.hash = hash;
            this.rawItem.type = type;
            $('#editorUploadModal').modal('show')
        },
        addEditorImage(ev, imageFile, imageFieldName){
            console.log('#preview_'+imageFile);
            console.log(ev);
            if (ev.target.files && ev.target.files[0]) {
                let blobImageFile = ev.target.files[0];
                this.editorImage = false; 
                this.editorVideo = true;
 
                if (ev.target.files[0].type.substring(0, 5) == "image"){
                    this.editorImage = true; 
                    this.editorVideo = false;
                } 

                // img convert to base64 string  for preview thumbnail
                let reader = new FileReader(); 
                reader.onload = function(e) {
                    $('#preview_'+imageFile).attr('src', e.target.result);
                    console.log($('#preview_'+imageFile))
                } 
                reader.readAsDataURL(ev.target.files[0]); 

                this.objform.delete(imageFieldName);
                this.objform.append(imageFieldName, blobImageFile);  
            }
        },
        submitEditorImage() {
            if(this.isUploading){
                return false;
            }

            this.isUploading = true;  

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post('/admin_api/listings/'+this.listing.hash+'/items/'+this.rawItem.hash+'/edited', this.objform, { headers })
                .then((response)=>{ 
                    console.log(response)
                    this.isUploading = false;  
                    $('#editorUploadModal').modal('hide');
                    alert('success')
                    location.reload();
                }).catch((error)=>{ 
                    console.log(error)
                    this.isUploading = false;  
                }); 
        }
    }
});