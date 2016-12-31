import Vue from 'vue';

export default {
  getAll() {
    return Vue.http.get('/api/projects');
  },

  getOne(id) {
    return Vue.http.get('/api/projects/' + id);
  }
}
