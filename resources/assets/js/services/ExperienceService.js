import Vue from 'vue';

export default {
  getAll() {
    return Vue.http.get('/api/experiences');
  },

  getOne(id) {
    return Vue.http.get('/api/experiences/' + id);
  }
}
