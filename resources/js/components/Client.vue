<template>
  <div class="container">
    <div class="row justify-content-start">
      <div class="col-12">
        <h2 class="text-center">{{ clientAddTitle }}</h2>
      </div>
    </div>
    <div class="shadow p-3 mb-5 bg-body rounded">
      <div class="row">
        <div class="col-12">
         <b>Company Details</b> 
        </div>
        <hr>
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
              v-model="item.cmp_phone"
            />
          </div>
        </div>
      </div>
     <br/>
      <div class="row">
        <div class="col-12">
          <b>Primary Details</b>
        </div>
        <hr>
      </div>
      <div class="row">
        <div class="col-4">
          <div class="form-group">
            <label>Client Name</label>
            <input
              type="text"
              placeholder="Enter Client Name"
              class="form-control"
              v-model="item.client_name"
            />
          </div>
        </div>
        
        <div class="col-4">
          <div class="form-group">
            <label>Client Email</label>
            <input
              type="text"
              placeholder="Enter Client Email"
              class="form-control"
              v-model="item.client_email"
            />
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label>Client Phone</label>
            <input
              type="text"
              placeholder="Enter Client Phone"
              class="form-control"
              v-model="item.client_phone"
            />
          </div>
        </div>
      </div>
      <div class="row mt-2">
        <div class="col-6">
          <div class="form-group">
            <button @click="save" class="btn btn-success">
              {{ isEditing ? "Update" : "Save" }}
            </button>
          </div>
        </div>
      </div>
    </div>
    <div class="shadow-lg p-3 mb-5 bg-body rounded">
      <div class="row">
        <div class="col-6">
          <label class="mt-2 fw-bold">Search :</label>
          <input
            class="ml-2"
            type="search"
            placeholder="Search here...."
            v-model="search"
            @keyup="getData"
          />
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 offset-md-3" v-if="lists.length === 0"></div>

        <table v-else class="table table-borderless caption-top">
          <caption>
            List of clients
          </caption>
          <thead>
            <tr>
              <th>#</th>
              <th>Company Name</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="table table-bordered">
            <tr v-for="(item, key) in lists" v-bind:key="item.client_id">
              <td>{{ incrementIndex(key) }}</td>
              <td>{{ item.company_name }}</td>
              <td>{{ item.address }}</td>
              <td>{{ item.cmp_phone }}</td>
              <td>
                <span class="float-right">
                  <button
                    class="btn btn-primary btn-sm mr-2"
                    @click="editClient(item)"
                  >
                    Edit
                  </button>
                  <button
                    @click="deleteClient(item.client_id)"
                    class="btn btn-danger btn-sm mr-2"
                  >
                    Delete
                  </button>

                  <button
                    type="button"
                    class="btn btn-primary"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    @click="viewClientDtls(item.client_id)"
                  >
                    view
                  </button>
                  <div
                    class="modal fade"
                    id="exampleModal"
                    tabindex="-1"
                    aria-labelledby="exampleModalLabel"
                    aria-hidden="true"
                  >
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">
                            Contact Details
                          </h5>
                          <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                          ></button>
                        </div>
                        <div class="modal-body">
                          <div
                            class="col-md-12 offset-md-3"
                            v-if="viewlists.length === 0"
                          ></div>
                          <p class="text-danger" v-if="error">{{ error}}</p>
                          <table class="table table-borderless caption-top">
                            <caption>
                              Clients Details
                            </caption>
                            <thead>
                              <tr>
                                <th>Id</th>
                                <th>Company Name</th>
                                <th>Address</th>
                                <th>Phone</th>
                              </tr>
                            </thead>

                            <tbody class="table table-bordered">
                              <tr v-if="viewlists.length < 0">
                                <td>{{ viewlists.client_id }}</td>
                                <td>{{ viewlists.company_name }}</td>
                                <td>{{ viewlists.address }}</td>
                                <td>{{ viewlists.cmp_phone }}</td>
                              </tr>
                              <tr v-else>
                                <td>{{ viewlists.client_id }}</td>
                                <td>{{ viewlists.company_name }}</td>
                                <td>{{ viewlists.address }}</td>
                                <td>{{ viewlists.cmp_phone }}</td>
                              </tr>
                            </tbody>
                          </table>

                          <ul>
                            <span
                              v-for="(childItem, key) in viewlists.contact"
                              v-bind:key="childItem.client_id"
                            >
                              <b> {{ incrementIndex(key)==1 ? 'Primary' : 'Secondary' }} Details</b>
                              <li class="list-unstyled">
                                <b>Name: </b>{{ childItem.name }}
                              </li>
                              <li class="list-unstyled">
                                <b>Email: </b>{{ childItem.email }}
                              </li>
                              <li class="list-unstyled">
                                <b>Phone: </b>{{ childItem.phone }}
                              </li>
                              <br />
                            </span>
                          </ul>
                        </div>
                        <div class="modal-footer">
                          <button
                            type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal"
                          >
                            Close
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
import { ref } from 'vue'
export default {
  name: "Client",
  data() {
    return {
      srno: 1,
      clientListTitle: "Client List",
      clientAddTitle: "Add Client",
      lists: [],
      viewlists: [],
      item: {
        company_name: "",
        address: "",
        cmp_phone: "",
        client_name: "",
        client_email: "",
        client_phone: "",
        showModal: false,
        search: "",
      },
      search: null,
      temp_id: null,
      isEditing: false,
      error : ref(''),
    };
  },
  mounted() {
    this.fetchAll();
  },
  methods: {
    fetchAll() {
      try {
        axios
          .get("/api/Client", this.item)
          .then((res) => (this.lists = res.data.data));
      } catch (e) {}
    },
    save() {
      let method = axios.post;
      let url = "/api/Client";

      if (this.isEditing) {
        method = axios.put;
        url = `/api/Client/${this.temp_id}`;
      }
      try {
        method(url, this.item).then((res) => {
          this.fetchAll();
          this.item = {
            company_name: "",
            address: "",
            cmp_phone: "",
          };
          (this.temp_id = null), (this.isEditing = false);
        });
      } catch (e) {}
    },
    deleteClient(id) {
      try {
        axios.delete(`/api/Client/${id}`).then((res) => this.fetchAll());
      } catch (e) {}
    },
    editClient(clientItem) {
      this.item = {
        company_name: clientItem.company_name,
        address: clientItem.address,
        cmp_phone: clientItem.cmp_phone,
        client_name: clientItem.contact[0]["name"],
        client_email: clientItem.contact[0]["email"],
        client_phone: clientItem.contact[0]["phone"],
      };

      this.temp_id = clientItem.client_id;
      this.isEditing = true;
    },
    getData() {
      try {
        axios
          .get(`/api/search/${this.search}`)
          .then((res) => (this.lists = res.data.data));
      } catch (e) {
        error.value = e.response.data.message;
      }
    },
    viewClientDtls(item_id) {
      console.log(item_id);
      try {
        axios.get(`/api/Client/${item_id}`).then((res) => {
          this.viewlists = res.data.data;
          console.log(res.data.data);
        });
      } catch (e) {}
    },
    incrementIndex(key) {
      return key + 1;
    },
  },
};
</script>

<style>
</style>