Vue.component('listings-show', {
    props: ['objlisting'],

    data() {
        return {
            listing: {},
            isLoading: false,
        }
    }, 

    mounted() {  
        console.log(this.objlisting)
        this.listing = this.objlisting;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});