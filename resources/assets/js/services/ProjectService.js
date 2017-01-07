import Vue from 'vue';

export default {
  getAll() {
    return Vue.http.get('/api/projects');
  },

  getOne(id) {
    return Vue.http.get('/api/projects/' + id);
  },

  store(data) {
    return Vue.http.post('/api/projects', data);
  },

  update(id, data) {
    return Vue.http.put('/api/projects/' + id, data);
  },

  reorder(data) {
    return Vue.http.post('/api/projects/reorder', data);
  }
}
