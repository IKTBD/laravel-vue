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
                <h3 class="card-title">Dashboard</h3>
              </div>
              <div class="card-body">
               This is Dashboard
			   <br>1) Please click the "My Info" to see your information
			   <br>2) Please click the "Logout" to logout your account
			   
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>
    </div>
</div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>