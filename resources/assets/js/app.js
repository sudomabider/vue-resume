import Vue from 'vue'
import VueRouter from 'vue-router'
import Resource from 'vue-resource'
import auth from './services/AuthService'
import App from './components/App.vue';
import HomeView from './views/HomeView.vue'
import ExperienceView from './views/ExperienceView.vue'
import ExperienceCreate from './views/ExperienceCreate.vue'
import ExperienceEdit from './views/ExperienceEdit.vue'
import ProjectView from './views/ProjectView.vue'
import ProjectCreate from './views/ProjectCreate.vue'
import ProjectEdit from './views/ProjectEdit.vue'
import ProjectReorder from './views/ProjectReorder.vue'
import LoginView from './views/LoginView.vue'
import { year, yearMonth } from './filters/timeFilters'

// Install some plugins
Vue.use(VueRouter);
Vue.use(Resource);

// Register filters globally
Vue.filter('year', year);
Vue.filter('yearMonth', yearMonth);

const routes = [
  {path: '/', name: 'home', component: HomeView},
  {path: '/experiences/:id(\\d+)', name: 'experience.show', component: ExperienceView},
  {path: '/projects/:id', name: 'project.show', component: ProjectView},
  {path: '/login', name: 'login', component: LoginView, meta: {guest: true}},

  {path: '/experiences/create', name: 'experience.create', component: ExperienceCreate, meta: {auth:true}},
  {path: '/experiences/:id/edit', name: 'experience.edit', component: ExperienceEdit, meta: {auth:true}},

  {path: '/projects/create', name: 'project.create', component: ProjectCreate, meta: {auth:true}},
  {path: '/projects/:id/edit', name: 'project.edit', component: ProjectEdit, meta: {auth:true}},
  {path: '/projects/reorder', name: 'project.reorder', component: ProjectReorder, meta: {auth:true}},

  {path: '*', redirect: '/'}
];

export const router = new VueRouter({
  mode: 'history',
  base: '/',
  routes // short for routes: routes
});

router.beforeEach((to, from ,next) => {

  if (to.meta.auth && !auth.user.authenticated) {
    next('/login');
  }

  if (to.meta.guest && auth.user.authenticated) {
    next('/');
  }

  next();

});

Vue.http.interceptors.push((request, next) => {

  request.headers.map['Authorization'] = ['Bearer ' + auth.getToken()];

  next();
});

new Vue({
  data() {
    return {
      state: {
        user: {}
      },
    }
  },
  computed: {
    authenticated() {
      return this.state.user.authenticated;
    }
  },
  template: `<App/>`,
  created () {
    this.state.user = auth.user;
    auth.init();
  },
  router,
  components: {
    App
  }
}).$mount('#root');