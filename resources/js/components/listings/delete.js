Vue.component('listings-delete', {
    props: ['objlisting'],

    data() {
        return {
            listing: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.listing = this.objlisting;
    },  

    computed: {
        
    },

    methods: {  
        deleteListing(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/listings/'+this.listing.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'Listing has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = '/listings/';
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting listing';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});