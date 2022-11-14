 <template>
  <div class="container">
 	<div class="row">
 		<router-link to="/stock" class="btn  btn-primary">Stock</router-link>
 	</div>
	<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Stock Update</h1>
                  </div>
                  <form class="user" @submit.prevent="ProductUpdate" >

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-12">
                           <label for="exampleFormControlSelect1">Product Stock </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" 
                                  placeholder="Enter Product Quaintity" v-model="form.product_quantity">
                                 <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                      </div>    
                    </div>
                    

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Update Prodect</button>
                    </div>
                    <hr>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
</template>

<script type="text/javascript">
  export default {
    created(){
      if (!User.logedIn()) {
        this.$router.push({ name: '/'})
      }
    },


     data(){
    return {
      form:{
        
        product_quantity: ''
      },
      errors:{},
      
       }
    },
    created(){
       let id = this.$route.params.id
       axios.get('/api/product/'+id)
       .then(({data}) => (this.form = data))
       .catch(console.log('error'))

       
    },
    methods:{
    	ProductUpdate(){
      let id = this.$route.params.id     
      axios.post('/api/stock/update/'+id,this.form)
      .then(() => {
        this.$router.push({ name: 'stock'})
         Notification.success()
        // Swal.fire({
        //   position: 'top-end',
        //   icon: 'success',
        //   title: 'Employee Update Successfully',
        //   showConfirmButton: false,
        //   timer: 1500
        // })
      })
      .catch(error => this.errors = error.response.data.errors)
      },

     
      
    	}

    }
  
  
</script>

<style type="text/css">
</style>