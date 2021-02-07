Vue.component('items-show', {
    props: ['objitem'],

    data() {
        return {
            item: {
                listing: {
                    hash: ''
                }
            },
            chatBody: '',
            isLoading: false,
            messages: []
        }
    }, 

    mounted() {   
        console.log(this.objitem);
        this.item = this.objitem;
        this.messages = this.objitem.chat.messages_asc;

        console.log(this.messages)
        
        this.scrollChat(); 
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
        },

        submitChat() {
            let msg = $.trim(this.chatBody);

            if(!msg) { 
                return false;
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            let chatUrl = '/admin_api/chats/'+this.item.chat.hash+'/messages'

            axios.post(chatUrl, {'msg': msg}, { headers })
                .then((response)=>{ 
                    if(response && response.data && response.data.status == 'success') {
                        this.messages.push(response.data.message);
                    }

                    this.chatBody = ''
                    this.scrollChat();

                }).catch((error)=>{ 
                    console.log(error)
                }); 

            console.log(msg)
        },

        scrollChat() {
            setTimeout(()=>{  
                var elChatArea = $('#chatList');
                elChatArea.scrollTop(elChatArea.prop("scrollHeight"));
            }, 500);
        },

        getChatClass(sender) {
            let chatClass = 'alert-primary text-right  ml-40'

            if(sender == 'user') {
                chatClass = 'alert-dark text-left mr-40'
            }

            return chatClass
        }
    }
});