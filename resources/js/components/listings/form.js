Vue.component('listings-form', {
    props: ['objlisting', 'url', 'action'],

    data() {
        return {
            
            listing: {},
            isLoading: false,
            errors: [],
            msgError: '',
            msgSuccess: '',
            objform : null,
            arrFileFields: []
        }
    }, 

    mounted() {  
        this.listing = this.objlisting; 
        this.objform = new FormData();
        this.listing.editor_id = this.listing.editor_id ? this.listing.editor_id : '';

        
    },  

    computed: {
        
    },

    methods: {   
        submitListing(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;

            // construct the formdata
            for ( var key in this.listing ) {
                if(!this.arrFileFields.includes(key)) {
                    this.objform.delete(key);
                    this.objform.append(key, this.listing[key] + '');
                }
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post(this.url, this.objform, { headers })
                .then((response)=>{ 
                    this.errors = []; 
                    this.msgSuccess = 'listing details has been successfully saved.';
                    this.msgError = '';
                    this.isLoading = false;

                    // redirect to listing page after creating
                    if(this.action == 'post'){
                        setTimeout(()=>{
                            window.location = '/listings/'+response.data.hash;
                        }, 500)
                    }

                }).catch((error)=>{ 
                    this.errors = error.response.data.errors;
                    this.msgError = 'Error in saving listing details.';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        },

        

        
    }
});