<template>
<div>
<div class="content-wrapper">
<section class="content">

      <div class="container-fluid">
        <div class="row">
          <div class="col-12" style="margin-top: 80px;">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Edit Info</h3>
              </div>
              <div class="card-body">
               
			   
			   
			   
			   <div class="row">
			   <div class="col-md-3"></div>
          <div class="col-md-6">

            <!-- Profile Image -->
            
              <div class="card-body box-profile">
                <div class="text-center">
                  <!-- <img id="image" class="profile-user-img img-fluid img-circle" src="images/avatar2.png" alt="User profile picture" style="opacity: 0.5;" title="Change">
				  <i class="nav-icon fa fa-plus" style="position: absolute;left: 49%;top: 65px;opacity: 0.5;"></i> -->
				  <br>
				  <br>
                </div>
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
				  
				  <div class="row">
                    <div class="col-6">
					<div class="form-group">
                    <label for="birthday">Birthday*</label>
                    <input v-model="birthday" type="date" class="form-control" value="2021-09-29" required>
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

                <span class="text-center" style="width:100%;">
				<button @click="update_info()" class="btn btn-primary"><b>Update</b></button>
				<a href="#/info"><button id="cancel" class="btn btn-primary"><b>Cancel</b></button></a>
				</span>
              </div>
              <!-- /.card-body -->
           
            <!-- /.card -->


          </div>
          <!-- /.col -->
            
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
			   
			   
			   
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
    </section>
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
                sex:'',
                birthday:''
              }
        },
        methods:{
           async update_info()
            {
              var token=window.localStorage.getItem('token');
              var url='/update';
              var headers = {headers:{'X-Api-Token':token}}
              var payloader={'first_name':this.first_name,'last_name':this.last_name,'sex':this.sex,'birthday':this.birthday}
              var result='';
              
              await axios
              .post(url,payloader,headers)
              .then(response => (result= response));

              alert(result.data.Message);
            }
        },
        async mounted() {
          var token=window.localStorage.getItem('token');
            var url='/user';
            var headers = {headers:{'X-Api-Token':token}}
            var payloader={}
            var result='';
            
            await axios
            .post(url,payloader,headers)
            .then(response => (result= response));

            if(result.data!='')
            {
              this.first_name=result.data.first_name;
              this.last_name=result.data.last_name;
              this.email=result.data.email;
              this.sex=result.data.sex;
              this.birthday=result.data.birthday;
            }
            else{alert(result.data.Message)}
        }
    }
</script>