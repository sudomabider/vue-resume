import Vue from 'vue'

export default {
  store(projectId,data) {
    return Vue.http.post('/api/projects/' + projectId + '/skills', data);
  },

  update(projectId, skillId, data) {
    return Vue.http.put('/api/projects/' + projectId + '/skills/' + skillId, data);
  },

  delete(projectId, skillId) {
    return Vue.http.delete('/api/projects/' + projectId + '/skills/' + skillId);
  }
}