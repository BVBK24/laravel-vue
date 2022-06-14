<template>
    <div class="home">
        <div class="container-fluid">
            <div class="row bg-dark">
                <div class="col-lg-12">
                    <p class="text-center text-light display-4 pt-2" style="font-size:25px;">Crud application using vue</p>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row mt-3">
                <div class="col-lg-6">
                    <h3 class="text-info">Registered Users</h3>
                </div>
                <div class="col-lg-6">
                    <button class="btn btn-info" style="float:right;">
                        <i class="fa fa-user"></i>&nbsp;&nbsp;Add User
                    </button>
                </div>
            </div>
            <hr class="bg-dark">
            <div class="alert alert-danger" v-if="errorMsg">
                Deleted
            </div>
            <div class="alert alert-success" v-if="successMsg">
                Success
            </div> 

            <!-- table structure-->

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
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>