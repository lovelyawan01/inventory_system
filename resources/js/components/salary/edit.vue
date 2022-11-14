 <template>
  <div class="container">
  <div class="row">
    <router-link to="/employee" class="btn  btn-primary">All Employee</router-link>
  </div>
  <div class="row justify-content-center">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-left">
                    <h1 class="h4 text-gray-900 mb-4">Pay Salary</h1>
                  </div>
                  <form class="user" @submit.prevent="SalaryPaidUpdate">

                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Name</b> </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter Full Name" v-model="form.name">
                                <small class="text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </div>
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Email</b> </label>
                          <input type="email" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp"
                                  placeholder="Enter Email Address" v-model="form.email">
                                 <small class="text-danger" v-if="errors.email">{{ errors.email[0] }}</small>
                        </div>
                      </div>    
                    </div>
                    <div class="form-group">
                      <div class="form-row">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Months</b> </label>
                          <select class="form-control" id="exampleFormControlSelect1" v-model="form.salary_month">
                           <option value="january"> January</option>
                           <option value="february"> February</option>
                           <option value="march"> March</option>
                           <option value="april"> April</option>
                           <option value="may"> May</option>
                           <option value="june"> June</option>
                           <option value="jully"> Jully</option>
                           <option value="august"> August</option>
                           <option value="september"> September</option>
                           <option value="october"> October</option>
                           <option value="november"> November</option>
                           <option value="december"> December</option>
                          </select>
                           <small class="text-danger" v-if="errors.salary_month">{{ errors.salary_month[0] }}</small>
                       </div>
                       <input type="hidden" v-model="form.employee_id">
                        <div class="col-md-6">
                          <label for="exampleFormControlSelect1"><b>Salary</b> </label>
                          <input type="text" class="form-control" id="exampleInputFirstName" placeholder="Enter sallery" v-model="form.amount">
                                <small class="text-danger" v-if="errors.amount">{{ errors.amount[0] }}</small>
                        </div>
                      </div>    
                    </div>
                   

                  
                    
                    


                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Pay Salary</button>
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
        name: '',
        email: '',
        salary_month: '',
        amount: '',
        employee_id: ''
      },
      errors:{}  
       }
    },
    created(){
       let id = this.$route.params.id
       axios.get('/api/edit/sallery/'+id)
       .then(({data}) => (this.form = data))
       .catch(console.log('error'))
    },
    methods:{
  
      SalaryPaidUpdate(){
       let id = this.$route.params.id     
      axios.post('/api/sallery/update/'+id,this.form)
      .then(() => {
        this.$router.push({ name: 'all-salary'})
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
      created(){
        this.SalaryPaid();
      }

     
      
      }

    }
  
  
</script>

<style type="text/css">
</style>