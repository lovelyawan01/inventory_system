 <template>
  <div class="container-fluid">
 	<div class="row">
 		<router-link to="/customer/create" class="btn  btn-primary">Add Customer</router-link>
 	</div>
	
                  <!-- <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Simple Tables</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item">Tables</li>
              <li class="breadcrumb-item active" aria-current="page">Simple Tables</li>
            </ol>
          </div> -->
          <br>
         <div id="dataTableHover_wrapper" class="dataTables_wrapper dt-bootstrap4">
         <div class="row">
          <div class="col-sm-12 col-md-6">
          <div class="dataTables_length" id="dataTableHover_length">
            <label>Show 
               <select name="dataTableHover_length" aria-controls="dataTableHover" class="custom-select custom-select-sm form-control form-control-sm">
                <option value="10">10</option>
                <option value="25">25</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>entries
            </label>
          </div>
        </div>
        <div class="col-sm-12 col-md-6">
          <div id="dataTableHover_filter" class="dataTables_filter float-right">
            Search:<input type="search" v-model="searchTerm" class="form-control form-control-sm" style="width: 300px;" placeholder="" aria-controls="dataTableHover">
            
          </div>
        </div>
      </div>
      <div class="row"><div class="col-sm-12"><table class="table align-items-center table-flush table-hover dataTable" id="dataTableHover" role="grid" aria-describedby="dataTableHover_info">
      </table>
    </div>
  </div>
</div>
          
          <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Customer List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="customer in filtersearch" :key="customer.id" class="mt-r">
                        <td> {{ customer.name }} </td>
                        <td> {{ customer.email }} </td>
                        <td><img :src="customer.photo" id="em_photo"></td>
                        <td>{{ customer.phone }}</td>
                        <td>
                          <router-link :to="{name: '/customer/edit/', params:{id:customer.id}}" class="btn btn-sm btn-primary">Edit</router-link>
                          <a  @click="deletecustomer(customer.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
                        </td>
                      </tr>
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->

          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
     <!--  </div> -->

</template>

<script type="text/javascript">
  export default {
    created(){
      if (!User.logedIn()) {
        this.$router.push({ name: '/'})
      }
    },
    data(){
      return{
        customers:[],
        searchTerm:''
      }
    },
    computed:{
      filtersearch(){
        return this.customers.filter(customer => {
            return customer.name.match(this.searchTerm)
        })
      }
    },
      
    methods:{
    	allcustomer(){
        axios.get('/api/customer/')
        .then(({data}) => (this.customers = data))
        .catch()
      },
    deletecustomer(id){
      Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          axios.delete('/api/customer/'+id)
          .then(() => {
            this.customers = this.customers.filter(customer => {
              return customer.id != id
            })
          })
          .catch(() => {
            this.$router.push({ name: 'customer'})
          })
           Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        }
      })
    }



    },
    created(){
      this.allcustomer();
    }
  }
  
</script>

<style type="text/css">
  #em_photo {
    height: 60px;
    width: 60px;
  }

</style>