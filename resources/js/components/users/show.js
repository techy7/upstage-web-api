Vue.component('users-show', {
    props: ['objuser'],

    data() {
        return {
            user: {
                plan: {}
            },
            isLoading: false,
        }
    }, 

    mounted() {
        this.user = this.objuser;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});