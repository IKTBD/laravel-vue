<template>
    <div>
    <nav class="main-header navbar navbar-expand navbar-white navbar-light" style="position:fixed;margin-left: 0px;width:100%;">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#/dashboard" class="nav-link">Dashboard</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#/wallet" class="nav-link">Wallet</a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#/help" class="nav-link">Help</a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <!-- Navbar Search -->
            <!-- Notifications Dropdown Menu -->
            <li class="nav-item">
                <img src="images/avatar2.png" style="width:40px;height:40px;">
            </li>
            <li class="nav-item dropdown show">
                <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true" onclick="document.getElementById('top_dropdown').classList.toggle('show')">
                    Hi {{first_name}} {{last_name}}!
                    <i class="fa fa-angle-down"></i>
                </a>
                <div id="top_dropdown" class="dropdown-menu dropdown-menu-right" style="left: inherit; right: 0px;">

                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                        <li class="nav-item">
                            <a href="#/info" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    My Info
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#/setting" class="nav-link">
                                <i class="nav-icon fa fa-wrench"></i>
                                <p>
                                    Setting
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#/logout" class="nav-link">
                                <i class="nav-icon fa fa-times-circle"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Message End -->
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
    <aside class="main-sidebar elevation-4" style="background:#fff;top: 56px;">
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image text-center" style="width:90%;color: #007bff;">
                    <img src="images/avatar2.png" class="img-circle elevation-2" alt="User Image"
                        style="width:50px;height:50px;margin-bottom: 10px;">
                    <span class="d-block text-center" style="width:100%;">{{first_name}} {{last_name}}</span>
                    <span class="d-block text-center" style="width:100%;">{{email}}</span>
                    <span class="d-block text-center" style="width:100%;">{{sex}}</span>
                </div>
            </div>
            <hr>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <a href="#/dashboard" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Dashboard
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#/info" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                My Info
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#/setting" class="nav-link">
                            <i class="nav-icon fa fa-wrench"></i>
                            <p>
                                Setting
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#/logout" class="nav-link">
                            <i class="nav-icon fa fa-times-circle"></i>
                            <p>
                                Logout
                            </p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
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
