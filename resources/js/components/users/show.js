Vue.component('users-show', {
    props: ['objuser'],

    data() {
        return {
            user: {},
            isLoading: false,
        }
    }, 

    mounted() {  
        console.log(this.objuser)
        this.user = this.objuser;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});