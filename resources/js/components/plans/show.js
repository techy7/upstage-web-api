Vue.component('plans-show', {
    props: ['objplan'],

    data() {
        return {
            plan: {},
            isLoading: false,
        }
    }, 

    mounted() {  
        console.log(this.objplan)
        this.plan = this.objplan;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});