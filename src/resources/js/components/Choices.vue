<template>
    <v-row justify="space-around">
        <v-col
            v-for="(choice) in choices"
            :key="choice.id"
        >
        <Choice :choice="choice"></Choice>
        </v-col>
    </v-row>
</template>

<script>
import Choice from './Choice';

export default {
  name: 'Choices',
  components: { Choice },
  props: [
    'user_role',
    'poll_id',
  ],
  data() {
    return {
      choices: {},
    };
  },
  mounted() {
    this.refreshChoices();
  },
  methods: {
    refreshChoices() {
      window.axios.get(`/polls/${this.poll_id}/choices`)
        .then((response) => {
          this.choices = response.data;
          // eslint-disable-next-line no-console
          console.log(this.choices);
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log('erreur chargement des choix', error);
        });
    },
  },
};
</script>

<style scoped>

</style>
