import Vue from 'vue';
import {router} from '../app';

export default {

  user: {
    authenticated: false,
    id: 0,
    name: '',
    email: ''
  },

  login (context, credentials) {
    Vue.http.post('/api/login', credentials)
      .then(({data: {token}}) => {
        context.hideError();

        this.setToken(token);
        this.getUserInfo(token);

        router.push('/');
      }, (error) => {
        context.showError();
      });
  },

  check() {
    return this.user.authenticated;
  },

  getUserInfo (token) {
    token = token || localStorage.getItem('jwt-token');
    
    if (!token) {
      return false;
    }

    Vue.http.get('/api/me')
      .then(({data}) => {
        if (typeof data === 'object' && data.user) {
          this.user.id = data.user.id;
          this.user.name = data.user.name;
          this.user.email = data.user.email;
          this.user.authenticated = true;
        }
      }, ({data}) => {
        localStorage.removeItem('jwt-token');
        if (! data.refreshed_token) {
          router.push('/login');
        }
      });
  },

  init () {
    this.getUserInfo();
  },

  logout () {
    const token = this.getToken();

    if (this.user.authenticated && token) {
      this.user.authenticated = false;
      this.user.id = 0;
      this.user.name = '';
      this.user.email = '';

      localStorage.removeItem('jwt-token');

      if (router.currentRoute.meta.auth) {
        router.push('/login');
      }
    }
  },

  getToken () {
    return localStorage.getItem('jwt-token');
  },

  setToken (token) {
    localStorage.setItem('jwt-token', token);
  }

}
