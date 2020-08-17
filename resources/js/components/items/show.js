Vue.component('items-show', {
    props: ['objitem'],

    data() {
        return {
            item: {},
            isLoading: false,
        }
    }, 

    mounted() {  
        console.log(this.objitem)
        this.item = this.objitem;
    },  

    computed: {
        
    },

    methods: {  
        
    }
});