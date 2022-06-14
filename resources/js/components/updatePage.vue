<template>
    <div id="updatePage">
            <div class="container-fluid">
                <div class="row bg-dark">
                </div>
            </div>
            <div class="container bg-light">
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h3 class="text-info">Update User</h3>
                    </div>
                </div>
                <hr class="bg-dark">

                <div class="row bg-light">
                    <div class="col-lg-6 m-auto">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="text-center  display-9 pt-2" style="font-size:25px;">Update User</h3>
                            </div>
                            <div class="card-body"> 
                                <p v-if="crud.length>0">not found</p>
                                <form>
                                    <!-- <p v-if="error.length"><b>Please correct the following errors</b>
                                    <ul><li v-for="er in error" v-bind:key="er" style="color:red">{{er}}</li></ul></p>  -->
                                    <!-- <div class="form-group">
                                        <label for="idInput">ID</label>
                                        <input type="text" id="idInput" class="form-control" placeholder="ID" v-model="insert.id"/>
                                    </div><br> -->
                                    <div class="form-group">
                                        <label for="nameInput">Name</label>
                                        <input type="text" id="nameInput" class="form-control" placeholder="Name" v-model="crud.name">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="mailInput">Mail</label>
                                        <input type="text" id="mailInput" class="form-control" placeholder="Mail" v-model="crud.email">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="phoneInput">Phone</label>
                                        <input type="text" id="phoneInput" class="form-control" placeholder="Phone" v-model="crud.phone">
                                    </div><br>
                                    <button type="button" @click="updateRecord()" class="btn btn-info"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Submit</button> 
                                </form>
                            </div>
                            <div class="card-footer"></div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</template>
<script>
// import { response } from 'express';

export default{
    data(){
        return{
            crud:[]
        }
    },
    mounted(){
        this.editProduct(this.$route.params.cid);
    },
    methods:{
        editProduct(cid){
            this.axios.get(`http://127.0.0.1:8001/api/crud/${cid}`).then((response)=>{
                this.crud=response.data;
            });
            },
            updateRecord(){
                this.axios.patch(`http://127.0.0.1:8001/api/crud/${this.$route.params.cid}`,this.crud).then((response)=>{
                    this.$router.push({name:'indexPage'});
                });
            }
        }
}
</script>
