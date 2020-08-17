Vue.component('items-form', {
    props: ['objitem', 'url', 'action', 'redirect_url'],

    data() {
        return {
            
            item: {},
            isLoading: false,
            errors: [],
            msgError: '',
            msgSuccess: '',
            objform : null,
            arrFileFields: []
        }
    }, 

    mounted() {  
        this.item = this.objitem; 
        this.objform = new FormData();

        
    },  

    computed: {
        
    },

    methods: {   
        submitItem(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;

            // construct the formdata
            for ( var key in this.item ) {
                // if(!this.arrFileFields.includes(key)) {
                //     this.objform.delete(key);
                //     this.objform.append(key, this.item[key] + '');
                // }

                if(!this.arrFileFields.includes(key)) { 
                    this.objform.delete(key);   
                    if(this.item[key]) {
                        this.objform.append(key, this.item[key] + '');
                    } 
                }
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post(this.url, this.objform, { headers })
                .then((response)=>{ 
                    this.errors = []; 
                    this.msgSuccess = 'Item details has been successfully saved.';
                    this.msgError = '';
                    this.isLoading = false;

                    // redirect to item page after creating
                    if(this.action == 'post'){
                        setTimeout(()=>{
                            window.location = this.redirect_url;
                        }, 500)
                    }

                }).catch((error)=>{ 
                    this.errors = error.response.data.errors;
                    this.msgError = 'Error in saving item details.';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        },

        updateFile(ev, imageFile, imageFieldName){
            console.log('#preview_'+imageFile);
            if (ev.target.files && ev.target.files[0]) {
                let blobImageFile = ev.target.files[0];

                console.log(imageFile, Math.ceil(ev.target.files[0].size/1024/1024) + "MB");

                // img convert to base64 string  for preview thumbnail
                // let reader = new FileReader(); 
                // reader.onload = function(e) {
                //     $('#preview_'+imageFile).attr('src', e.target.result);
                //     console.log($('#preview_'+imageFile))
                // } 
                // reader.readAsDataURL(ev.target.files[0]); 

                this.objform.delete(imageFieldName);
                this.objform.append(imageFieldName, blobImageFile);  

                // add this field to the array of excluded formdata conversion
                this.arrFileFields.push(imageFieldName)
            }
        },

        
    }
});