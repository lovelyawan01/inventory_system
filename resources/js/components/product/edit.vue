 <template>
  <div class="container">
 	<div class="row">
 		<router-link to="/product" class="btn  btn-primary">All Product</router-link>
 	</div>
	<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Product Update</h1>
                  </div>
                  <form class="user" @submit.prevent="ProductUpdate" enctype="multipart/form-data">

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                           <label for="exampleFormControlSelect1">Product Name </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter product Name" v-model="form.product_name">
                                <small class="text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                        </div>
                        <div class="col-md-6">
                           <label for="exampleFormControlSelect1">Product Code </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" 
                                  placeholder="Enter Product Code" v-model="form.product_code">
                                 <small class="text-danger" v-if="errors.product_code">{{ errors.product_code[0] }}</small>
                        </div>
                      </div>    
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1">Product category </label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.category_id">
                            <option :value="category.id" v-for="category in categories">{{ category.category_name }}</option>
                          </select>
                       </div>
                       <div class="col-md-6">
                          <label for="exampleFormControlSelect1">Product Supplier </label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.supplier_id">
                            <option :value="supplier.id" v-for="supplier in suppliers">{{ supplier.name }}</option>
                           
                          </select>
                       </div>

                     </div>
                   </div>

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-4">
                           <label for="exampleFormControlSelect1">Product Root </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter product Name" v-model="form.root">
                                <small class="text-danger" v-if="errors.root">{{ errors.root[0] }}</small>
                        </div>
                        <div class="col-md-4">
                           <label for="exampleFormControlSelect1">Buying Price </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Buying Price" v-model="form.buying_price">
                                 <small class="text-danger" v-if="errors.buying_price">{{ errors.buying_price[0] }}</small>
                        </div>
                        <div class="col-md-4">
                           <label for="exampleFormControlSelect1">Selling Price</label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Selling Price" v-model="form.selling_price">
                                 <small class="text-danger" v-if="errors.selling_price">{{ errors.selling_price[0] }}</small>
                        </div>
                      </div>    
                    </div>

                     <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6" id="simple-date1">
                          <label for="exampleFormControlSelect1">Buying Date </label>
                          <div class="input-group date">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                              </div>
                              <input type="date" class="form-control" id="simpleDataInput"  v-model="form.buying_date">
                            </div>
                                <small class="text-danger" v-if="errors.buying_date">{{ errors.buying_date[0] }}</small>
                        </div>
                        <div class="col-md-6">
                           <label for="exampleFormControlSelect1">Product Quantity </label>
                          <input type="text" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                  placeholder="Enter Email Address" v-model="form.product_quantity">
                                 <small class="text-danger" v-if="errors.product_quantity">{{ errors.product_quantity[0] }}</small>
                        </div>
                      </div>    
                    </div>
            

                  <div class="form-group">
                    <div class="form-row">
                      <div class="custom-file col-md-6">
                        <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                        <small class="text-danger" v-if="errors.image">{{ errors.image[0] }}</small>
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                      <div class="col-md-6">
                      <img :src="form.image" style="height: 40px; width: 40px;">
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
         product_name: '',
        product_code: '',
        category_id: '',
        supplier_id: '',
        root: '',
        buying_price: '',
        selling_price: '',
        buying_date: '',
        image: '',
        newimage: '',
        product_quantity: ''
      },
      errors:{},
      categories:{},
      suppliers:{}, 
       }
    },
    created(){
       let id = this.$route.params.id
       axios.get('/api/product/'+id)
       .then(({data}) => (this.form = data))
       .catch(console.log('error'))

        axios.get('/api/category/')
        .then(({data}) => (this.categories = data))

         axios.get('/api/supplier/')
        .then(({data}) => (this.suppliers = data))
    },
    methods:{
      onFileSelected(event){
        let file = event.target.files[0];
        if (file.size > 1048770) {
           Notification.img_validation()
        }
        else{
          let reader = new FileReader();
          reader.onload = event =>{
            this.form.newimage = event.target.result
          };

          reader.readAsDataURL(file);
        }
      },
    	ProductUpdate(){
      let id = this.$route.params.id     
      axios.patch('/api/product/'+id,this.form)
      .then(() => {
        this.$router.push({ name: 'product'})
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