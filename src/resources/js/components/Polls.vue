<template>
    <v-container>
        <v-row
            v-for="(poll) in polls"
            :key="poll.id">
            <v-col>
                <Poll
                    :user_id="user_id"
                    :user_role="user_role"
                    :poll="poll">
                </Poll>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import Poll from './Poll';

export default {
  name: 'Polls',
  components: { Poll },
  data() {
    return {
      polls: {},
    };
  },
  props: [
    'user_role',
    'user_id',
    'presentation_id',
  ],
  mounted() {
    this.refreshPolls();
  },
  methods: {
    refreshPolls() {
      const { alert } = this.$parent.$parent.parentRefs;
      window.axios.get(`/presentations/${this.presentation_id}/polls`)
        .then((response) => {
          this.polls = response.data;
        })
        .catch(() => {
          alert.showMessage('error', 'Oops erreur lors de la récupération des sondages');
        });
    },
  },
};
</script>

<style scoped>

</style>
