import Vue from 'vue'
import VueRouter from 'vue-router'
import Resource from 'vue-resource'
import auth from './services/AuthService'
import App from './components/App.vue';
import HomeView from './views/HomeView.vue'
import LoginView from './views/LoginView.vue'
// import TopicView from './components/TopicView'
// import {fromNow, largeNumbers} from './filters/index'
import ExperienceView from './views/ExperienceView.vue'
import { year } from './filters/timeFilters'

// Install some plugins
Vue.use(VueRouter);
Vue.use(Resource);

// Register filters globally
Vue.filter('year', year);

// Register filters globally
//Vue.filter('fromNow', fromNow);
//Vue.filter('largeNumbers', largeNumbers);

const routes = [
  {path: '/', name: 'home', component: HomeView},
  {path: '/experiences/:id', name: 'experience.show', component: ExperienceView},
  // 'topic/:topicId': {
  //   name: 'topic',
  //   component: TopicView
  // },
  {path: '/login', name: 'login', component: LoginView, guest: true},
  {path: '*', redirect: '/'}
];

const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes // short for routes: routes
});

// router.beforeEach((to, from ,next) => {
//   localStorage.setItem('prevPage', from);
//
//   // if (transition.to.auth && !auth.user.authenticated) {
//   //   transition.redirect('/login');
//   // } else if (transition.to.guest && auth.user.authenticated) {
//   //   transition.redirect('/');
//   // } else {
//   //   transition.next();
//   // }
//
//   next();
// });

// Vue.http.interceptors.push((request, next) => {
//
//   const token = auth.getToken();
//   request.headers['Authorization'] = 'Bearer ' + token;
//
//   request.headers['X-CSRF-TOKEN'] = document.querySelector('meta[name="token"]').content;
//
//   next();
//
//   // (response) => {
//   //
//   //   if (response.status == 404) {
//   //     router.go('/');
//   //   } else if (response.status == 401 && response.data.refreshed_token) {
//   //     // If you received 401 "Unauthorized" response
//   //     // with a refreshed_token in the payload,
//   //     // this means you've got to refresh your token
//   //     auth.setToken(response.data.refreshed_token);
//   //   }
//   // }
// });

//auth.checkAuth();

new Vue({
  router,
  template: `<App>`,
  components: {
    App
  }
}).$mount('#root');

