Vue.component('users-delete', {
    props: ['objuser'],

    data() {
        return {
            user: {},
            isLoading: false,
            msgSuccess: ''
        }
    }, 

    mounted() {  
        this.user = this.objuser;
    },  

    computed: {
        
    },

    methods: {  
        deleteUser(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;
            
            axios.delete('/admin_api/users/'+this.user.hash)
                .then((response)=>{ 
                    this.msgError = '';
                    this.msgSuccess = 'User has been successfully deleted.';
                    this.isLoading = false;

                    setTimeout(()=>{
                        window.location = '/users/';
                    }, 500)
                }).catch((error)=>{ 
                    this.msgError = 'Error in deleting user';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        }
    }
});