<template>
    <div class="indexPage">
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h3 class="text-info">Registered Users</h3>
                </div>
                <div class="col-lg-6">
                    <button @click="$router.push('/laravu/create')" class="btn btn-info" style="float:right;">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;Add User
                    </button>
                </div>
            </div>
            <hr class="bg-dark">
                <div class="row mt-3">
                    <form class="form-inline" @submit.prevent="list(1)">
                        <label for="category_filter">Filter by &nbsp;</label>
                            <select class="form-control" id="category_filter" name="category" v-model="filter">
                                <option disabled value="">Select Column</option>
                                <option value="global">Global Filter</option>
                                <option value="id">ID</option>
                                <option value="name">Name</option>
                                <option value="email">Mail</option>
                                <option value="phone">Phone</option>
                            </select>
                            <label for="keyword">&nbsp;&nbsp;</label>
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" v-model="search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                    </form>
                </div>
            <!-- table structure-->
            <br>

            <div class="row">
                <div class="col-lg-12">
                
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr class="text-center bg-info text-ligth">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Mail</th>
                                <th>Phone</th>
                                <th>Update</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>   
                            <td v-if="!crud.length" colspan="6" class="text-center text-ligth">No Record Found</td>
                            </tr>
                            <tr v-for="cru in crud" v-bind:key="cru.id" class="text-center text-ligth">
                                <td>{{cru.id}}</td>
                                <td>{{cru.name}}</td>
                                <td>{{cru.email}}</td>
                                <td>{{cru.phone}}</td>
                                <td><button><router-link :to="{name:'updatePage',params:{cid:cru.id}}"><i style='color:brown' class="fa fa-edit"></i></router-link></button></td>
                                <!-- <td><router-link :to="`/home/update/+{obj.id}`"><i class="fa fa-edit"></i></router-link></td> -->
                                <td><button><i class="fa fa-trash" @click="deleteRecord(cru.id)" style='color: red'></i></button></td>

                            </tr>
                            
                            
                            
                        </tbody>
                    </table>
                </div>
                <div style="display:flex">
                <button @click="list(1)">1</button>
                <button @click="list(2)">2</button>
                <button @click="list(3)">3</button>
                </div>
                <!-- <pagination v-if="crud" align="center" :data="crud" @pagination-change-page="list"></pagination> -->
            </div>
        </div>
    </div>
</template>
<script>
import pagination from 'laravel-vue-pagination'
// import { response } from 'express';

export default{
    components:
    {
        pagination
    },
    data(){
        return{
            search:'',
            filter:'',
            crud:{},
            paginationNumber:1
        }
    },
    watch:{
        paginationNumber:function(newValue){
            this.list(newValue)
        }
    },
    // created(){
    //     this.getRecord();
    // },
    mounted(){
        this.list(this.paginationNumber)
    },
    methods:{
        async list(page=1){
            console.log('hello');
            console.log(this.filter);
            await this.axios.get(`http://127.0.0.1:8001/api/crud?page=${page}&filter=${this.filter}&search=${this.search}`).then((response)=>{
                this.crud=response.data.data
                console.log(this.crud)
                console.log(response.data)
            }).catch((response)=>{
                console.error(response)
            })
        },
        // getRecord(){
        //     this.axios.get('http://127.0.0.1:8001/api/crud').then(response=>{this.crud=response.data}).catch(error=>{console.log(error)})
        // },
        deleteRecord(inputId){
            this.axios.delete(`http://127.0.0.1:8001/api/crud/${inputId}`).then(response=>{
                let i=this.crud.map(data=>data.id).indexOf(inputId);
                this.crud.splice(i,1)
            });
        }
    }
}
</script>
<style scoped>
    .pagination{
        margin-bottom: 0;
    }
</style>
