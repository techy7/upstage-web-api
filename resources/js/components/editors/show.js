Vue.component('editors-show', {
    props: ['objeditor'],

    data() {
        return {
            editor: {
                plan: {}
            },
            isLoading: false,
        }
    }, 

    mounted() {
        this.editor = this.objeditor;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});