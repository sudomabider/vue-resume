import Vue from 'vue'

export default {
  store(experienceId,data) {
    return Vue.http.post('/api/experiences/' + experienceId + '/skills', data);
  },

  update(experienceId, skillId, data) {
    return Vue.http.put('/api/experiences/' + experienceId + '/skills/' + skillId, data);
  },

  delete(experienceId, skillId) {
    return Vue.http.delete('/api/experiences/' + experienceId + '/skills/' + skillId);
  }
}