 <template>
  <div class="container-fluid">
 	<div class="row">
 		<router-link to="/expense" class="btn  btn-primary">All Expense</router-link>
 	</div>
	<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Add Expense</h1>
                  </div>
                  <form class="user" @submit.prevent="ecpenseInsert">

                    <div class="form-group">
                    	<div class="form-row">
                    		<div class="col-md-6">
                    			<input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Amount" v-model="form.amount">
                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                    		</div>
                    		<div class="col-md-6" id="simple-date1">
                          <div class="input-group date">
                              <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                              </div>
                              <input type="date" class="form-control" id="simpleDataInput"  v-model="form.epense_date">
                            </div>
                                <small class="text-danger" v-if="errors.epense_date">{{ errors.epense_date[0] }}</small>
                        </div>
                    	</div>    
                    </div>
                    <div class="form-group">
                    	<div class="form-row">
                    		<div class="col-md-12">
                    			<textarea type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter details" v-model="form.details" ></textarea>
                                <small class="text-danger" v-if="errors.details">{{ errors.details[0] }}</small>
                    		</div>
                    	   
                    </div>
                  </div>
                  

                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Expense</button>
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
        amount: null,
        epense_date: null,
        details: null
      },
      errors:{}  
       }
    },
    methods:{
      
    	ecpenseInsert(){     
      axios.post('/api/expense/',this.form)
      .then(() => {
        this.$router.push({ name: 'expense'})
        Notification.success()
      })
      .catch(error => this.errors = error.response.data.errors)
      },

     
      
    	}

    }
  
  
</script>

<style type="text/css">
</style>