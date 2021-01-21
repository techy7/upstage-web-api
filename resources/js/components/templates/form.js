Vue.component('templates-form', {
    props: ['objtemplate', 'url', 'action', 'objoptions', 'objtypes'],

    data() {
        return {
            
            template: {},
            isLoading: false,
            errors: [],
            msgError: '',
            msgSuccess: '',
            objform : null,
            arrFileFields: [],
            catOptions: []
        }
    }, 

    mounted() {  
        this.template = this.objtemplate; 
        this.objform = new FormData();

        if(this.template.type) {
            let origCat = this.template.category; 
            this.filterCatsByType();
            this.template.category = origCat;
        } 
    },  

    computed: {
        
    },

    methods: {  
        filterCatsByType() { 
            this.catOptions = [];
            this.template.category = ''

            if(this.template.type) {
                this.catOptions = this.objoptions[this.template.type];
            } 
        },

        submitTemplate(){
            if(this.isLoading){
                return false;
            }

            this.isLoading = true;

            // construct the formdata
            for ( var key in this.template ) {
                if(!this.arrFileFields.includes(key)) {
                    this.objform.delete(key);
                    this.objform.append(key, this.template[key] + '');
                }
            }

            let headers = {
                'Content-Type': 'application/json;charset=utf-8'
            }

            axios.post(this.url, this.objform, { headers })
                .then((response)=>{ 
                    this.errors = []; 
                    this.msgSuccess = 'Template details has been successfully saved.';
                    this.msgError = '';
                    this.isLoading = false;

                    // redirect to template page after creating
                    if(this.action == 'post'){
                        setTimeout(()=>{
                            window.location = '/templates/'+response.data.hash;
                        }, 500)
                    }

                }).catch((error)=>{ 
                    this.errors = error.response.data.errors;
                    this.msgError = 'Error in saving template details.';
                    this.msgSuccess = '';
                    this.isLoading = false;
                }); 
        },

        
        updateFile(ev, imageFile, imageFieldName){
            console.log('#preview_'+imageFile);
            if (ev.target.files && ev.target.files[0]) {
                let blobImageFile = ev.target.files[0];

                console.log(imageFile, Math.ceil(ev.target.files[0].size/1024/1024) + "MB");

                // img convert to base64 string  for preview thumbnail
                // let reader = new FileReader(); 
                // reader.onload = function(e) {
                //     $('#preview_'+imageFile).attr('src', e.target.result);
                //     console.log($('#preview_'+imageFile))
                // } 
                // reader.readAsDataURL(ev.target.files[0]); 

                this.objform.delete(imageFieldName);
                this.objform.append(imageFieldName, blobImageFile);  

                // add this field to the array of excluded formdata conversion
                this.arrFileFields.push(imageFieldName)
            }
        },
        
    }
});