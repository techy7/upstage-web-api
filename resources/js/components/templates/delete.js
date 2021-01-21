Vue.component('templates-delete', {
    props: ['objtemplate'],

    data() {
        return {
            template: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.template = this.objtemplate;
    },  

    computed: {
        
    },

    methods: {  
        deleteTemplate(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/templates/'+this.template.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'Template has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = '/templates/';
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting template';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});