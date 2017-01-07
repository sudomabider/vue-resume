import Vue from 'vue'

export default {
  store(experienceId,data) {
    return Vue.http.post('/api/experiences/' + experienceId + '/highlights', data);
  },

  update(highlightId, data) {
    return Vue.http.put('/api/highlights/' + highlightId, data);
  },

  delete(highlightId) {
    return Vue.http.delete('/api/highlights/' + highlightId);
  }
}