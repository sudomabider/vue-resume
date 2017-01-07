import Vue from 'vue';

export default {
  getAll() {
    return Vue.http.get('/api/experiences');
  },

  getOne(id) {
    return Vue.http.get('/api/experiences/' + id);
  },

  store(data) {
    return Vue.http.post('/api/experiences', data);
  },

  update(id, data) {
    return Vue.http.put('/api/experiences/' + id, data);
  }
}
