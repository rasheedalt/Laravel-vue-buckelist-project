<template>
    <div class="col-lg-6 mt-2 container">
        <div class="col-md-2 col-lg-6">
            <h6><span class="badge badge-secondary">New bucketlist</span></h6>
            <i 
                class="right fa fa-plus-square fa-3x"
                @click.prevent="form=!form"></i>  
        </div>
        <div class=" col-sm-auto card card-body  container" v-if="form" >
            <h4 class="text-center">Create new Bucketlist</h4>
             <form action="" class="form row">
                 <div class="form-group col">
                     <input type="text" class="form-control mb-1" placeholder="name" v-model="name">
                 </div>
                 <div class="form-group col">
                    <input type="text" class="form-control" placeholder="created_by" v-model="created">                
                 </div>
            <button class="btn btn-block btn-dark mt-2 pt-0" @click.prevent="b_save()">create</button>
        </form>
        </div>
    </div>
</template>
<script>
export default {

    data(){
        return{
            name:'',
            created: '',
            bucket_edit:'',
            bucketlistid:'',
            form: false

        }
    },
    methods:{
        b_save(){
                var user = this.$auth.user().id;
               const formData= new FormData();
               formData.append('user', user);
               formData.append('name', this.name);
               formData.append('creator', this.created);
               //console.log(formData)
               if(this.bucket_edit === null){
               axios.post(`/bucketlists`, formData)
                .then((response)=>{
                console.log(response);
                alert('Saved!');
                this.form = false
                }),
                this.name=this.done = "";
               }else{
                   axios.post(`/bucketlists/${this.bucketlistid}`, formData)
                    .then((response)=>{
                    //console.log(response);
                    alert('Saved!');
                    this.form = false

                    }),
                    this.name=this.done = "";
               }
    }
    }
}
</script>