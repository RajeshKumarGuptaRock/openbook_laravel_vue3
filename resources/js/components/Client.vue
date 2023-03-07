<template>
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-12">
        <h2 class="text-center">{{ clientAddTitle }}</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-4">
        <div class="form-group">
          <label>Company Name</label>
          <input
            type="text"
            placeholder="Enter Company Name"
            class="form-control"
            v-model="item.company_name"
          />
        </div>
      </div>
      <div class="col-4">
        <div class="form-group">
          <label>Address</label>
          <input
            type="text"
            placeholder="Enter Address"
            class="form-control"
            v-model="item.address"
          />
        </div>
      </div>
      <div class="col-4">
        <div class="form-group">
          <label>Phone</label>
          <input
            type="text"
            placeholder="Enter Phone"
            class="form-control"
            v-model="item.phone"
          />
        </div>
      </div>
    </div>  
    <div class="row mt-2">
      <div class="col-6">
        <div class="form-group">
          <button @click="save" class="btn btn-success">
            {{ isEditing ? 'Update':'Save' }}
    
        </button>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 offset-md-3" v-if="lists.length === 0"></div>
      <h2 class="text-center">{{ clientListTitle }}</h2>
      <table>
        <thead>
            <tr>
                <td>Sr.</td>
                <td>Company Name</td>
                <td>Address</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody class="table table-bordered">
            <tr v-for="item in lists" v-bind:key="item.id">
                <td>{{srno+1}}</td>
                <td>{{ item.company_name }}</td>
                <td>{{ item.address }}</td>
                <td>{{ item.phone }}</td>
                <td>
                    <span class="float-right">
                    <button class="btn btn-primary btn-sm mr-2" @click="editClient(item)">Edit</button>
                    <button  @click="deleteClient(item.id)" class="btn btn-danger btn-sm mr-2">Delete</button>
                  </span>
                </td>
            </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  name: "Client",
  data() {
    return {
        srno:1,
      clientListTitle: "Client List",
      clientAddTitle: "Add Client",
      lists: [],
      item: {
        company_name: "",
        address: "",
        phone: "",
      },
      temp_id:null,
      isEditing:false,
    };
  },
  mounted(){
    this.fetchAll()
  },
  methods: {
    fetchAll() {
      try {
        axios.get("/api/Client", this.item).then((res => this.lists = res.data.data));
      } catch (e) {}
    },
    save() {
        let method = axios.post;
        let url = '/api/Client';

        if(this.isEditing){
            method = axios.put;
            url = `/api/Client/${this.temp_id}`
        }
      try {
        method(url, this.item)
        .then(res => {
            this.fetchAll();
            this.item={
                company_name:"",
                address:"",
                phone:""
            };
            this.temp_id= null,
            this.isEditing= false
        });
      } catch (e) {}
    },
    deleteClient(id){
        try {
            axios.delete(`/api/Client/${id}`).then((res => this.fetchAll()));
      } catch (e) {}
    },
    editClient(clientItem){
        this.item ={
            company_name:clientItem.company_name,
            address:clientItem.address,
            phone:clientItem.phone
        }
        this.temp_id = clientItem.id;
        this.isEditing = true
    },
  },
};
</script>

<style>
</style>