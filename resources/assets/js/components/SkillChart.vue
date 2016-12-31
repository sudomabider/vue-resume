<script>
  import { Doughnut } from 'vue-chartjs'

  export default Doughnut.extend({
    props: ['skills'],

    computed: {
      labels() {
        return this.skills.map(function(skill) {
          return skill.name
        });
      },
      data() {
        return this.skills.map(function(skill) {
          return skill.percentage
        });
      },
      colors() {
        return this.skills.map(function(skill) {
          return skill.color
        });
      }
    },

    mounted () {
      this.renderChart({
        labels: this.labels,
        datasets: [
          {
            label: 'Relevant Skills',
            data: this.data,
            backgroundColor: this.colors
          }
        ]
      })
    }
  })
</script>