 <template>
 <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Pos Dashboard</li>
            </ol>
          </div>

          <div class="row mb-3">
    
            <!-- Area Chart -->
            <div class="col-xl-5 col-lg-5">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Expense Insert</h6>
                  <router-link to="customer/create" class="btn btn-sm btn-info" ><font color="#fffffff">Add Customer</font></router-link>
                  
                </div>
                

              <div class="table-responsive" style="font-size: 12px;">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Qty</th>
                        <th>Unit</th>
                        <th>Total</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="cart in carts" :key="cart.id">
                        <td>{{ cart.pro_name }}</td>
                        <td>
                        <button @click.prevent="increment(cart.id)" class="btn btn-sm btn-success">+</button>
                        <input type="text" readonly="" :value="cart.pro_quantity" style="width: 15px;">
                        <button  @click.prevent="decrement(cart.id)" class="btn btn-sm btn-danger" v-if="cart.pro_quantity >= 2">-</button>
                        <button class="btn btn-danger btn-sm" v-else="" disabled="">-</button>
                        </td>
                        <td>{{ cart.product_price }}</td>
                        <td>{{ cart.sub_total}}</td>
                        <td><a  @click="removeitem(cart.id)" class="btn btn-sm btn-primary"><font color="#ffffff">X</font></a></td>
                      </tr>
                      
                      
                    </tbody>
                  </table>
                </div>
                <div class="card-footer">
                  <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center">Total Quantity:
                      <strong>{{ qty }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Sub Total:
                      <strong>{{ subtotal }}</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Vat :
                      <strong :key="vat.id">{{ vats.vat }}%</strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">Total :
                      <strong>{{ parseInt(subtotal) * parseInt(vats.vat) /100 + parseInt(subtotal) }}</strong>
                    </li>
                  </ul>

                  <br>

                  <form @submit.prevent="orderdone">
                    <label>Customer Name</label>
                    <select class="form-control" v-model="customer_id">
                      <option  v-for="customer in customers" :value="customer.id" >{{ customer.name }}</option>
                     
                    </select>

                    <label>Pay</label>
                    <input type="text" class="form-control" required="" v-model="pay">

                    <label>Due</label>
                    <input type="text" class="form-control" required="" v-model="due">

                    <label>Pay By</label>
                    <select class="form-control" v-model="pay_by">
                      <option value="HandCash">Hand Cash</option>
                      <option value="Check">Check</option>
                      <option value="GiftCard">Gift Card</option>
                    </select>
                    <br>

                    <button type="submit" class="btn btn-success">Submit</button>
                  </form>
                </div>


              </div>
            </div>
            <!-- Pie Chart -->
            <div class="col-xl-7 col-lg-7">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Products Sold</h6>
                  <div id="dataTableHover_filter" class="dataTables_filter float-right">
                    <input type="search" v-model="searchTerm" class="form-control form-control-sm" style="width: 300px;" placeholder="search Here" aria-controls="dataTableHover">
                    
                  </div>
                     </div>
                <!-- tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">All Products</a>
                    </li>
                    <li class="nav-item"  v-for="category in categories" :key="category.id">
                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" @click="subproduct(category.id)">{{ category.category_name  }}</a>
                    </li>
                    
                  </ul>
                  <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                      <div class="card-body">
                          <div class="row">
                           <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-3" v-for="product in filtersearch" :key="product.id">
                            <button class=" btn btn-sm" @click.prevent="AddToCart(product.id)">
                             <div class="card" style="width: 9rem;">
                                <img :src="product.image" id="em_photo" class="card-img-top">
                                <div class="card-body">
                                  <h6 class="card-title">{{ product.product_name }}</h6>
                                  <span class="badge badge-success" v-if="product.product_quantity >= 1">Available ( {{ product.product_quantity }} )</span>
                                  <span class="badge badge-danger" v-else=" ">stock-out</span>
                                </div>
                                </div>
                                </button>
                            </div>

                          </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                      <div class="card-body">
                          <div class="row">
                           <div class="col-lg-3 col-md-3 col-sm-6 col-6 mb-3" v-for="getproducts in Getfiltersearch" :key="getproducts.id">
                           <button class=" btn btn-sm" @click.prevent="AddToCart(getproducts.id)">
                             <div class="card" style="width: 9rem;">
                                <img :src="getproducts.image" id="em_photo" class="card-img-top">
                                <div class="card-body">
                                  <h6 class="card-title">{{ getproducts.product_name }}</h6>
                                  <span class="badge badge-success" v-if="getproducts.product_quantity >= 1">Available ( {{ getproducts.product_quantity }} )</span>
                                  <span class="badge badge-danger" v-else=" ">stock-out</span>
                                </div>
                                </div>
                                </button>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
             <!-- end tabs -->
             
                


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
        <!---Container Fluid-->

</template>

<script type="text/javascript">
  export default {
    created(){
      if (!User.logedIn()) {
        this.$router.push({ name: '/'})
      }
    },
    created(){
      this.Allproduct();
      this.AllCategory();
      this.AllCustomer();
      this.cartProduct();
      this.vat();
      Reload.$on('AfterAdd',() => {
        this.cartProduct();
      })
    },

    data(){
      return{
       customer_id:'',
       pay:'',
       due:'',
       pay_by:'',


        products:[],
        categories:'',
        getproducts:[],
        searchTerm:'',
        customers:'',
        errors:'',
        carts:'',
        vats:'',
      }
    },
    computed:{
      filtersearch(){
        return this.products.filter(product => {
            return product.product_name.match(this.searchTerm)
        })
      },
      Getfiltersearch(){
        return this.getproducts.filter(getproduct => {
            return getproduct.product_name.match(this.searchTerm)
        })
      },
      qty(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity));

        }
        return sum;
      },
      subtotal(){
        let sum = 0;
        for(let i = 0; i < this.carts.length; i++){
          sum += (parseFloat(this.carts[i].pro_quantity) * parseFloat(this.carts[i].product_price));

        }
        return sum;
      },
      orderdone(){
        let total =  this.subtotal*this.vats.vat /100 + this.subtotal;
        var data = {qty:this.qty, subtotal:this.subtotal, customer_id:this.customer_id, pay_by:this.pay_by, pay:this.pay, due:this.due, vat:this.vats.vat, total:total }

        axios.post('/api/orderdone/',data)
         .then(() => {
        Notification.success()
        this.$router.push({name: 'home'})
      })
      },
    },

      
    methods:{
      // Card Method
      AddToCart(id){
         axios.get('/api/AddToCart/'+id)
        .then(() => {
          Reload.$emit('AfterAdd')
          Notification.cart_success()
        })
        .catch()
      },
      cartProduct(){
        axios.get('/api/cart/product/')
        .then(({data}) => (this.carts = data))
        .catch()
      },
      removeitem(id){
         axios.get('/api/remove/cart/'+id)
        .then(() => {
          Reload.$emit('AfterAdd')
          Notification.cart_delete()
        })
        .catch()
      },
    increment(id){
       axios.get('/api/increment/'+id)
        .then(() => {
          Reload.$emit('AfterAdd')
          Notification.success()
        })
        .catch()
    },
    decrement(id){
      axios.get('/api/decrement/'+id)
        .then(() => {
          Reload.$emit('AfterAdd')
          Notification.success()
        })
        .catch()
    },
    vat(){
       axios.get('/api/vats/')
        .then(({data}) => (this.vats = data))
        .catch()
    },
      // end Cart
      Allproduct(){
        axios.get('/api/product/')
        .then(({data}) => (this.products = data))
        .catch()
      },
       AllCategory(){
        axios.get('/api/category/')
        .then(({data}) => (this.categories = data))
        .catch()
      },
      subproduct(id){
        axios.get('/api/getting/product/'+id)
        .then(({data}) => (this.getproducts = data))
        .catch()
      },
      AllCustomer(){
        axios.get('/api/customer/')
        .then(({data}) => (this.customers = data))
        .catch(console.log('error'))
      }

    }
    
  }
  
</script>
<style type="text/css" scoped>
  #em_photo {
    height: 100px;
    width: 135px;
  }
  .card .table td, .card .table th {
     padding-right: 0rem; 
     padding-left: 1rem; 
}

</style>