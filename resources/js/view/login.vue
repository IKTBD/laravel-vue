<template>
	<div class="row" style="width:99%">
		<div class="col-4"></div>
          
			<div class="col-4" style="margin-top: 80px;">
            <!-- Default box -->

           
			  <div class="card card-primary">
              <div class="card-header">
                <span class="card-title text-center" style="width:100%;font-size:20px;font-weight:bolder;">Login</span>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
                <div class="card-body">
                  <div class="form-group">
                    <label for="email">Email address</label>
                    <input v-model="myemail" type="email" class="form-control" placeholder="Enter email" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password</label>
                    <input v-model="mypassword" type="password" class="form-control" placeholder="Password" required>
                  </div>
                  <!-- <div class="form-check">
                    <input id="remember" type="checkbox" class="form-check-input">
                    <label class="form-check-label" for="remember">Remember me</label>
                  </div> -->
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button id="login" @click="user_login()" type="button" class="btn btn-primary">Login</button>
				  <span style="float:right;padding-top: 6px;"><a href="#/registration">Account Registration</a></span>
                </div>

          </div>
        </div>
	</div>
</template>

<script>
    export default {
      data(){
          return{
                login:'',
                myemail:'',
                mypassword:''
              }
        },
        methods:{
           async user_login()
            {
                if(this.myemail==''){ alert('Mail is empty');}
                else if(this.mypassword==''){alert('Password is empty');}
                else
                {
                    var url='/login';
                    var payloader={mail:this.myemail,password:this.mypassword}
                    
                    await axios
                    .post(url,payloader)
                    .then(response => (this.login = response));

                    if(this.login.data.Status==true)
                    {
                        var token=this.login.data.token;
                        window.localStorage.setItem('token',token);
                        this.$router.push('dashboard');
                    }
                    else{
                        alert(this.login.data.Message);
                    }
                }
            }
        },
        async mounted() {
        }
    }
</script>
