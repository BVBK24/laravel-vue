<template>
    <div id="createPage">
            <div class="container-fluid">
                <div class="row bg-dark">
                </div>
            </div>
            <div class="container bg-light">
                <div class="row mt-3">
                    <div class="col-lg-12">
                        <h3 class="text-info">Register User</h3>
                    </div>
                </div>
                <hr class="bg-dark">

                <div class="row bg-light">
                    <div class="col-lg-6 m-auto">
                        <div class="card mt-2">
                            <div class="card-header">
                                <h3 class="text-center  display-9 pt-2" style="font-size:25px;">Create User</h3>
                            </div>
                            <div class="card-body"> 
                                <form>
                                    <p v-if="error.length"><b>Please correct the following errors</b>
                                    <ul><li v-for="er in error" v-bind:key="er" style="color:red">{{er}}</li></ul></p> 
                                    <!-- <div class="form-group">
                                        <label for="idInput">ID</label>
                                        <input type="text" id="idInput" class="form-control" placeholder="ID" v-model="insert.id"/>
                                    </div><br> -->
                                    <div class="form-group">
                                        <label for="nameInput">Name</label>
                                        <input type="text" id="nameInput" class="form-control" placeholder="Name" v-model="insert.name">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="mailInput">Mail</label>
                                        <input type="text" id="mailInput" class="form-control" placeholder="Mail" v-model="insert.email">
                                    </div><br>
                                    <div class="form-group">
                                        <label for="phoneInput">Phone</label>
                                        <input type="text" id="phoneInput" class="form-control" placeholder="Phone" v-model="insert.phone">
                                    </div><br>
                                    <button type="button"  @click="insertData()" class="btn btn-info"><i class="fa fa-paper-plane"></i>&nbsp;&nbsp;Submit</button> 
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
    // import { response } from 'express'

export default{
    data(){
        return{
            insert:{},
            error:[]
        }
    },
    methods:{
        insertData(){
            if(this.checkForm()){
            this.axios.post(`http://127.0.0.1:8001/api/crud`,this.insert).then(response=>{
              this.$router.push({name:'indexPage'})
            }).catch(error=>{console.log(error)})}
        },
        checkForm(){
            this.error=[];
            if(!this.validChar(this.insert.name))
            {
                console.log('hello');
                this.error.push('name required');
            }
            if(!this.validEmail(this.insert.email))
            {
                this.error.push('Enter valid mail');
            }
            if(!this.validphone(this.insert.phone))
            {
                this.error.push('Enter 10 digit phone number');
            }
            if(this.error.length!=0){
                return false;
            }
            return true;
        },
        
        validEmail(mail){
            console.log(mail);
        var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(mail);
        },
        validphone(phone){
        var re=/^\d{10}$/;
        return re.test(phone);
        },
        validChar(name){
        var re=/^[a-zA-Z ]+$/;
        

        if(!name){

        return false;

        }
        name = name.trim();
        // console.log(name);
        // console.log(re.test(name));
        return re.test(name);
        }

    }
}
</script>
