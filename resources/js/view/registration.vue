<template>
  <div class="row" style="width:99%">
    <div class="col-4"></div>
    <div class="col-4" style="margin-top: 80px;">
      <!-- Default box -->


      <div class="card card-primary">
        <div class="card-header">
          <span class="card-title text-center" style="width:100%;font-size:20px;font-weight:bolder;">Registration Form</span>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div id="registration">
          <div class="card-body">

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="first_name">First Name*</label>
                  <input v-model="first_name" type="text" class="form-control" placeholder="First name" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="last_name">Last Name*</label>
                  <input v-model="last_name" type="text" class="form-control" placeholder="Last name" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="email">Email Address*</label>
              <input v-model="email" type="email" class="form-control" placeholder="Enter email" required>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="password">Password*</label>
                  <input v-model="password" type="password" class="form-control" placeholder="Password" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="confirm_password">Confirm Password*</label>
                  <input v-model="confirm_password" type="password" class="form-control" placeholder="Confirm Password"
                    required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-6">
                <div class="form-group">
                  <label for="birthday">Birthday*</label>
                  <input v-model="birthday" type="date" class="form-control" required>
                </div>
              </div>
              <div class="col-6">
                <div class="form-group">
                  <label for="sex">Sex*</label>
                  <select v-model="sex" class="form-control" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                  </select>
                </div>
              </div>
            </div>



            <div class="form-check">
              <input type="checkbox" class="form-check-input" v-model="read_terms" value="1">
              <label class="form-check-label" for="exampleCheck1">I have read the all terms and conditions</label>
            </div>
          </div>
          <!-- /.card-body -->

          <div class="card-footer">
            <button @click="registration()" class="btn btn-primary">Submit</button>
            <span style="float:right;padding-top: 6px;"><a href="#/login">Have an Account? Login HERE</a></span>
          </div>
          </div>
          <div id="success" style="text-align:center;display:none;">
            <div class="card-body">
              <i class="fa fa-check" style="background: #007bff;padding: 20px;border-radius: 50%;color: #fff;font-size: 70px;"></i>
              <p style="text-align: center;color:green;">Registration Successful</p>
              <p><a href="#/login">Go to Login page to Login</a></p>
            </div>
          </div>




          <!-- /.card -->
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
          return{
                result:'',
                first_name:'',
                last_name:'',
                email:'',
                password:'',
                confirm_password:'',
                sex:'',
                birthday:'',
                read_terms:''
              }
        },
        methods:{
           async registration()
            {
              if(this.read_terms==true)
              {
                var url='/registration';
                var payloader={'first_name':this.first_name,'last_name':this.last_name,'email':this.email,'password':this.password,'confirm_password':this.confirm_password,'sex':this.sex,'birthday':this.birthday}
                
                await axios
                .post(url,payloader)
                .then(response => (this.result = response));

                if(this.result.data.Status==true)
                {
                   document.getElementById('registration').style.display='none';
                   document.getElementById('success').style.display='block'; 
                }
                else{
                  alert(this.result.data.Message);
                }

              }
              else{alert('Please check the terms and conditions');}
            }
        },
    mounted() {
      console.log('Component mounted.')
    }
  }
</script>