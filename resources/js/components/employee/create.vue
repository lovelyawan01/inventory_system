 <template>
  <div class="container-fuild">
 	<div class="row">
 		<router-link to="/employees" class="btn  btn-primary">All Employee</router-link>
 	</div>
	<div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Add Employee</h1>
                  </div>
                  <form class="user" @submit.prevent="employeeInsert" enctype="multipart/form-data">

                    <div class="form-group">
                    	<div class="form-row">
                    		<div class="col-md-6">
                    			<input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name" v-model="form.name">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                    		</div>
                    		<div class="col-md-6">
                    			<input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                  placeholder="Enter Email Address" v-model="form.email">
                                 <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                    		</div>
                    	</div>    
                    </div>
                    <div class="form-group">
                    	<div class="form-row">
                    		<div class="col-md-6">
                    			<input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter phone" v-model="form.phone">
                                <small class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                    		</div>
                    		<div class="col-md-6">
                    			<input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter sallery" v-model="form.sallery">
                                <small class="text-danger" v-if="errors.sallery">{{ errors.sallery[0] }}</small>
                    		</div>
                    	</div>    
                    </div>
                    <div class="form-group">
                    	<div class="form-row">
                    		<div class="col-md-6">
                    			<input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter nid" v-model="form.nid">
                                <small class="text-danger" v-if="errors.nid">{{ errors.nid[0] }}</small>
                    		</div>
                    		<div class="col-md-6" id="simple-date1">
                    			<div class="input-group date">
			                        <div class="input-group-prepend">
			                          <span class="input-group-text"><i class="fas fa-calendar"></i></span>
			                        </div>
			                        <input type="date" class="form-control" id="simpleDataInput"  v-model="form.joining_date">
			                      </div>
                                <small class="text-danger" v-if="errors.joining_date">{{ errors.joining_date[0] }}</small>
                    		</div>

                    	</div>    
                    </div>

                  <div class="form-group">
                  	<div class="form-row">
                      <div class="custom-file col-md-6">
                        <input type="file" class="custom-file-input" id="customFile" @change="onFileSelected">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                      <div class="col-md-6">
                    	<img :src="form.photo" style="height: 40px; width: 40px;">
                    </div>
                    </div>
                    </div>
                     <div class="form-group">
                      <div class="form-row">
                        
                        <div class="col-md-12">
                          <textarea type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Address" v-model="form.address"></textarea>
                                <small class="text-danger" v-if="errors.Address">{{ errors.Address[0] }}</small>
                        </div>
                      </div>    
                    </div>

                    


                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Add Employee</button>
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
        name: null,
        email: null,
        phone: null,
        sallery: null,
        address: null,
        photo: null,
        nid: null,
        joining_date: null
      },
      errors:{}  
       }
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
            this.form.photo = event.target.result
            console.log(event.target.result);
          };

          reader.readAsDataURL(file);
        }
      },
    	employeeInsert(){     
      axios.post('/api/employees',this.form)
      .then(() => {
        this.$router.push({ name: 'employees'})
        Notification.success()
      })
      .catch(error => this.errors = error.response.data.errors)
      },

     
      
    	}

    }
  
  
</script>

<style type="text/css">
</style>