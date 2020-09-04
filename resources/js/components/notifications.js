Vue.component('notifications', {
    // props: [],

    data() {
        return {
            newusers: [],
            totalNotifs: 0
        }
    }, 

    mounted() {  
        this.fetchNewUserNotif();
        console.log('yeah')
    },  

    computed: {
        
    },

    methods: {   
        fetchNewUserNotif() { 
            axios.get('/notifications/unread')
                .then((response)=>{ 
                    console.log(response.data)
                    if(response && response.data){
                        
                    }
                }).catch((error)=>{
                    
                });
        },
    }
});