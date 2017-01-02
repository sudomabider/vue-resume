import Vue from 'vue';

export default {
  post(data) {
    return Vue.http.post('/api/contact', data);
  }
}
