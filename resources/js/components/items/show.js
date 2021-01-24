Vue.component('items-show', {
    props: ['objitem'],

    data() {
        return {
            item: {
                listing: {
                    hash: ''
                }
            },
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
        setStatus(status) {
            // 
            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            let statusUrl = '/admin_api/listings/'+this.item.listing.hash+'/items/'+this.item.hash+'/status'

            axios.post(statusUrl, {'status': status}, { headers })
                .then((response)=>{ 
                    if(response && response.data && response.data.status == 'success') {
                        this.item.status = response.data.item.status
                    }

                }).catch((error)=>{ 
                    console.log(error)
                }); 
        }
    }
});