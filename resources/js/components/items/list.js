Vue.component('items-list', {
    props: [],

    data() {
        return {
            
            items: {
                data:[],
                per_page: 3,
                total: 0,
                current_page: 1
            },
            filters: {
                page: 1,
                q:'',
                
            },
            isLoading: false,
        }
    }, 

    mounted() {  
        this.getList(1); 
        
        
    },  

    computed: {
        
    },

    methods: {  
        getList(page) {
            if(this.isLoading){
                return false;
            }
            
            this.isLoading = true;
            this.filters.page = page;
             
            axios.get('/admin_api/items/', { params: this.filters } )
                .then((response)=>{ 
                    if(response && response.data){
                        this.items = response.data;
                        this.isLoading = false;

                        $("html, body").animate({ scrollTop: 0 });
                    }
                }).catch((error)=>{
                    this.isLoading = false;
                });
        },

        getPage(page) {
            this.getList(page);
        },

        
    }
});