import Vue from 'vue'

export default {
  store(projectId,data) {
    return Vue.http.post('/api/projects/' + projectId + '/highlights', data);
  },

  update(highlightId, data) {
    return Vue.http.put('/api/highlights/' + highlightId, data);
  },

  delete(highlightId) {
    return Vue.http.delete('/api/highlights/' + highlightId);
  }
}