Vue.component('plans-form', {
    props: ['objplan', 'url', 'action'],

    data() {
        return {
            
            plan: {},
            isLoading: false,
            errors: [],
            msgError: '',
            msgSuccess: '',
            objform : null,
            arrFileFields: []
        }
    }, 

    mounted() {  
        this.plan = this.objplan; 
        this.objform = new FormData();

        
    },  

    computed: {
        
    },

    methods: {   
        submitPlan(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;

            // construct the formdata
            for ( var key in this.plan ) {
                if(!this.arrFileFields.includes(key)) {
                    this.objform.delete(key);
                    this.objform.append(key, this.plan[key] + '');
                }
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post(this.url, this.objform, { headers })
                .then((response)=>{ 
                    this.errors = []; 
                    this.msgSuccess = 'Plan details has been successfully saved.';
                    this.msgError = '';
                    this.isLoading = false;

                    // redirect to plan page after creating
                    if(this.action == 'post'){
                        setTimeout(()=>{
                            window.location = '/plans/'+response.data.hash;
                        }, 500)
                    }

                }).catch((error)=>{ 
                    this.errors = error.response.data.errors;
                    this.msgError = 'Error in saving plan details.';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        },

        

        
    }
});