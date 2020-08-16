Vue.component('users-form', {
    props: ['objuser', 'url', 'action'],

    data() {
        return {
            user: {},
            isLoading: false,
            errors: [],
            msgError: '',
            msgSuccess: '',
            objform : null,
            arrFileFields: []
        }
    }, 

    mounted() {  
        this.user = this.objuser; 
        this.objform = new FormData();

        
    },  

    computed: {
        
    },

    methods: {   
        submitUser(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;

            // construct the formdata
            // for ( var key in this.user ) {
            //     if(!this.arrFileFields.includes(key)) {
            //         this.objform.delete(key);
            //         this.objform.append(key, this.user[key] + '');
            //     }
            // }

            for ( var key in this.user ) {
                if(!this.arrFileFields.includes(key)) { 
                    this.objform.delete(key);   
                    if(this.user[key]) {
                        this.objform.append(key, this.user[key] + '');
                    } 
                }
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post(this.url, this.objform, { headers })
                .then((response)=>{ 
                    this.errors = []; 
                    this.msgSuccess = 'User details has been successfully saved.';
                    this.msgError = '';
                    this.isLoading = false;

                    // redirect to user page after creating
                    if(this.action == 'post'){
                        setTimeout(()=>{
                            window.location = '/users/'+response.data.hash;
                        }, 500)
                    }

                }).catch((error)=>{ 
                    this.errors = error.response.data.errors;
                    this.msgError = 'Error in saving user details.';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        },

        
        updateImage(ev, imageFile, imageFieldName){
            console.log('#preview_'+imageFile);
            if (ev.target.files && ev.target.files[0]) {
                let blobImageFile = ev.target.files[0];

                console.log(imageFile, Math.ceil(ev.target.files[0].size/1024/1024) + "MB");

                // img convert to base64 string  for preview thumbnail
                let reader = new FileReader(); 
                reader.onload = function(e) {
                    $('#preview_'+imageFile).attr('src', e.target.result);
                    console.log($('#preview_'+imageFile))
                } 
                reader.readAsDataURL(ev.target.files[0]); 

                this.objform.delete(imageFieldName);
                this.objform.append(imageFieldName, blobImageFile);  

                // add this field to the array of excluded formdata conversion
                this.arrFileFields.push(imageFieldName)
            }
        },
        
    }
});