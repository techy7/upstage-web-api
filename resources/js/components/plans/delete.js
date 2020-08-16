Vue.component('plans-delete', {
    props: ['objplan'],

    data() {
        return {
            plan: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.plan = this.objplan;
    },  

    computed: {
        
    },

    methods: {  
        deletePlan(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/plans/'+this.plan.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'Plan has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = '/plans/';
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting plan';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});