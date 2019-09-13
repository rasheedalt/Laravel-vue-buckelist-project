<template>
    <div class="justify-content-center">
        <div>
               <newbucketlist></newbucketlist>
                <div class=" col-sm-auto col-lg-6 container card card-body mt-2" v-if="bucket_edit">
                <h4 class="text-center">Edit Bucketlist</h4>
                <form action="" class="form row">
                 <div class="form-group col">
                     <input type="text" class="form-control mb-1" placeholder="name" v-model="b_name">
                 </div>
                 <div class="form-group col">
                    <input type="text" class="form-control" placeholder="created_by" v-model="creator">                
                 </div>
            <button class="btn btn-block btn-dark mt-2 pt-0" @click.prevent="b_edit()">create</button>
            </form>
                </div>
               
        </div>
    <div class="mt-3 col-lg-6 container">
        <h5>Bucketlists</h5>
        <div class="" v-for="bucketlist in bucketlists" :key="bucketlist.id">
        <div class="card card-body mb-2 bg-primary">
            <h4 class="text-white">{{bucketlist.name}} 
                <i class="right fa fa-sort-desc" @click.prevent="click(bucketlist.id)"></i>
                <i class="right fa fa-trash pr-3" 
                @click.prevent="deletebucketlist(bucketlist.id)"
                data-toggle="tooltip" data-placement="top" title="Delete Bucketlist"
                style=" color:red; float: right;" 
                ></i> 
                <i class="right fa fa-pencil pr-3" 
                @click.prevent="b_click(bucketlist.id)"
                data-toggle="tooltip" data-placement="top" title="Edit Bucketlist"
                style=" color:white; float: right;" 
                ></i>
            </h4>
            <p>created by: <b>{{bucketlist.created_by}}</b></p>
             <ul v-if="see===bucketlist.id" class="list-group">
                 <!-- form -->
                 <div v-if="itemform" class="card card-body">
                     <form action="" class="form row bg-white">
                        <div class="form-group col">
                            <label for="name">Name</label>
                            <input type="text" 
                                id="name" 
                                class="form-control mb-1" 
                                v-model="name" 
                                placeholder="name">
                        </div>
                        <div class="form-group col">
                            <label for="name">Done</label>
                            <select class="form-control"   v-model="done" >
                                <option value="true">True</option>
                                <option value="false">False</option>
                            </select>                
                        </div>
                        <button class="btn btn-block btn-dark mt-2 pt-0" @click.prevent="save()">save</button>
                </form>

                 </div>
                  
                <!-- end of form -->
                 <p v-if="length===0" class="alert alert-danger">No item in this bucketlist</p>
                 <button @click.prevent="itemform = !itemform" class="btn mb-1 text-white"> new item <i class="left fa fa-plus" style="color:green;"></i></button>
                 <div v-for="item in items" :key="item.id">
                     <li class="list-group-item mb-1">
                         <p><b>{{item.name}}</b></p>
                         <small>Date created: <b>{{item.created_at}}</b> || Done: <b>{{item.done}}</b></small>
                         <i class="right fa fa-pencil" data-placement="left" 
                            @click.prevent="editItem(item.id)" 
                            title="Edit item" style="float: right;"></i>
                         <i class="right fa fa-trash pr-3" 
                            @click.prevent="deleteItem(item.id)"
                            data-toggle="tooltip" data-placement="left" title="Delete item"
                            style="color:red; float: right;" 
                            ></i>
                            </li>
                         
                 </div>
            
        </ul>  
        </div>
        </div>
    </div>
    </div>
    

</template>
<script>


export default {
    
    
    data(){
        return{
            bucketlists:'',
            see:null,
            items: '',
            length: '',
            itemform: null,
            bucketlistid:'',
            name:'',
            done:'',
            edit: null,
            itemid:"",
            b_name:'',
            creator:'',
            b_form:null,
            bucket_edit:null,
            bucket:''
        }
    },
    mounted(){
        this.fetchdata()
    },
    methods:{
        fetchdata()
        {
            var user = this.$auth.user().id;
            axios.post(`/bucketlistss`,{user: user})
            .then((response)=>{
            //console.log(response.data);
            this.bucketlists = response.data});
        
        },
    b_edit(){
             const formData= new FormData();
               //formData.append('id', this.bucket);
               formData.append('name', this.b_name);
               formData.append('creator', this.creator);
             axios.post(`/bucketlists/${this.bucket}`, formData)
                .then((response)=>{
                    console.log(response.data)
                this.b_name = this.creator = '';
                alert('saved');
                this.bucket_edit = null;
                this.fetchdata()
                }).catch((error)=>{console.log(error)});
        }, 
    b_click(id){
            this.bucket = id;
            console.log(this.bucket)
            if(this.bucket_edit === null){this.bucket_edit = true}else{this.bucket_edit = null};
            if(this.bucket_edit ==  true){
                axios.get(`/bucketlists/${id}`)
                .then((response)=>{
                    console.log(response.data)
                this.b_name = response.data[0].name;
                this.creator = response.data[0].created_by;
                }).catch((error)=>{console.log(error)});
            }
        } ,
    click(a){
           if(this.see === null){this.see = a}else{this.see = null};
           if(this.see==a){
               this.bucketlistid = a;
                axios.get(`/bucketlists/${a}/items`)
                .then((response)=>{
                this.length = response.data.result.length;
                this.items = response.data.result;
                }).catch((error)=>{console.log(error)});
           }

           },
    deleteItem(item_id){
            //    console.log(item_id)

               if(confirm('Are you sure?')){
               axios.delete(`/item/${item_id}`)
                .then((response)=>{
                console.log(response.data);
                alert('Deleted!');
               })
               }
           },
    save(){
               const formData= new FormData();
               formData.append('name', this.name);
               formData.append('done', this.done);
               if(this.edit === null){
               axios.post(`/bucketlists/${this.bucketlistid}/item`, formData)
                .then((response)=>{
                //console.log(response);
                this.fetchdata()
                alert('Saved!');
                }),
                this.name=this.done = "";
               }else{
                   axios.post(`/bucketlists/${this.bucketlistid}/items/${this.itemid}`, formData)
                .then((response)=>{
                //console.log(response);
                this.fetchdata()
                alert('Saved!');
                }),
                this.name=this.done = "";
               }

           },
           editItem(item_id){
               this.edit = true;
               this.itemid = item_id;
               if(this.itemform === null){this.itemform = true }else{ this.itemform = null };

           if(this.itemform === true){
               axios.get(`/bucketlists/${this.bucketlistid}/items/${item_id}`)
                .then((response)=>{
               // console.log(response.data[0]);
                const result = response.data[0];
                //console.log("yes");
                this.name = result.name;
                this.done = result.done;
                this.fetchdata()
                })      
              }
           },
    deletebucketlist(id){
                if(confirm('Are you sure?')){
               axios.delete(`/bucketlists/${id}`)
                .then((response)=>{
                console.log(response.data);
                alert('Deleted!');
               })
               }
           }
    }
    
}
</script>
