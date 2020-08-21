Vue.component('items-delete', {
    props: ['objitem', 'listing_hash', 'redirect_url'],

    data() {
        return {
            item: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.item = this.objitem;
    },  

    computed: {
        
    },

    methods: {  
        deleteItem(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/listings/'+this.listing_hash+'/items/'+this.item.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'item has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = this.redirect_url;
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting item';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});