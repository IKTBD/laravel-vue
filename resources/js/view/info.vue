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
                <h3 class="card-title">My info</h3>
              </div>
              <div class="card-body">
               
			   <div class="row">
			   <div class="col-md-3"></div>
          <div class="col-md-6">

            <!-- Profile Image -->
            
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle" src="images/avatar2.png" alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{first_name}} {{last_name}}</h3>

                <ul class="list-group list-group-unbordered mb-3">
                  <li class="list-group-item">
                    <b>First Name</b> <a class="float-right">{{first_name}}</a>
                  </li>
				  <li class="list-group-item">
                    <b>Last Name</b> <a class="float-right">{{last_name}}</a>
                  </li>
				  <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{email}}</a>
                  </li>
				  <li class="list-group-item">
                    <b>Birthday</b> <a class="float-right">{{birthday | dateformat}}</a>
                  </li>
                  <li class="list-group-item">
                    <b>Sex</b> <a class="float-right">{{sex}}</a>
                  </li>

                </ul>

                <span class="text-center" style="width:100%;">
				<a href="#/edit"><button class="btn btn-primary"><b>Edit</b></button></a>
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
        filters: {

              dateformat: function (value) {

              var ml = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
              var ms = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sept', 'Oct', 'Nov', 'Dec'];
              var date_array=value.split('-');
              var mydate=ms[Number(date_array[1])-1]+' '+date_array[2]+', '+date_array[0];
              return mydate;
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