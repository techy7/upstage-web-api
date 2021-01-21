Vue.component('templates-show', {
    props: ['objtemplate'],

    data() {
        return {
            template: {},
            isLoading: false,
        }
    }, 

    mounted() {   
        this.template = this.objtemplate;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});