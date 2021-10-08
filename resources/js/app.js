
require('./bootstrap');
window.Vue = require('vue').default;
import VueRouter from 'vue-router'
Vue.use(VueRouter)
import {routes} from './route/route.js'
const router = new VueRouter({routes});
router.beforeEach(async (to, from, next) => {
    var token=window.localStorage.getItem('token');
    var url='/login_check';
    var headers = {headers:{'X-Api-Token':token}}
    var payloader={}
    var login_check='';     
    await axios.post(url,payloader,headers).then(response => (login_check = response));

    if (to.fullPath == '/' || to.fullPath == '/login' || to.fullPath=='/registration')
    {
        if(login_check.data.Status==true)
        {
            next({ path: '/dashboard'})
        }
        else
        {
            next(); Vue.component('menu-vue', {template: ''})
        }
    }
    else
    {
        if(to.fullPath == '/logout')
        {
            var token=window.localStorage.getItem('token');
            var url='/logout';
            var headers = {headers:{'X-Api-Token':token}}
            var payloader={}
            var result='';
            
            await axios
            .post(url,payloader,headers)
            .then(response => (result= response));

            if(result.data.Status==true)
            {
                window.localStorage.setItem('token','');
                next({ path: '/login'})
            }
            else{alert(result.data.Message)}
        }
        else
        {
            if(login_check.data.Status==true)
            {
                Vue.component('menu-vue',require('./view/files/menu.vue').default);
                next();
            }
            else
            {
                Vue.component('menu-vue', {template: ''})
                next({ path: '/login'})
            }
        }
        
    }
  })
const app = new Vue({router}).$mount('#app');
