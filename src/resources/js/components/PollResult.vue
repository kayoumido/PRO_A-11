<template>
    <v-row v-if="is_loaded">
        <v-col>
            <v-sparkline
                fill
                show-labels
                smooth
                auto-line-width
                label-size="3"
                height="20"
                :type="type"
                :gradient="gradient"
                :labels="votes.choice_message"
                :value="votes.votes"
            ></v-sparkline>
        </v-col>
    </v-row>
</template>

<script>
export default {
  name: 'PollResult',
  props: [
    'poll_id',
  ],
  data() {
    return {
      votes: {},
      is_loaded: false,
      gradient: ['#f72047', '#ffd200', '#1feaea'],
      type: 'bar',
    };
  },
  mounted() {
    window.axios.get(`/polls/${this.poll_id}/results`)
      .then((response) => {
        this.votes = response.data;
        this.is_loaded = true;
        // eslint-disable-next-line no-console
        console.log(response);
      })
      .catch(() => {
        this.$emit('error', 'Oops problème lors du chargements des résultats');
      });
  },
};
</script>
