Vue.component('editors-delete', {
    props: ['objeditor'],

    data() {
        return {
            editor: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.editor = this.objeditor;
    },  

    computed: {
        
    },

    methods: {  
        deleteEditor(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/editors/'+this.editor.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'Editor has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = '/editors/';
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting editor';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});