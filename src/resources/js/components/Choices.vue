<template>
    <v-row justify="space-around">
        <v-col
            v-for="(choice) in choices"
            :key="choice.id"
            class="col-2"
        >
            <Choice
                v-on:choice-done="$emit('choice-done', $event)"
                v-on:error="$emit('error', $event)"
                v-on:update-choices="refreshChoices"
                :choice="choice"
                :user_role="user_role"
                :user_id="user_id"
                :poll_id="poll_id"></Choice>
        </v-col>
        <v-col v-show="user_role === 'presenter'" class="col-2">
            <CreateChoice
                v-on:error="$emit('error', $event)"
                v-on:update-choices="refreshChoices"
                :poll_id="poll_id"></CreateChoice>
        </v-col>
    </v-row>
</template>

<script>
import Choice from './Choice';
import CreateChoice from './CreateChoice';

export default {
  name: 'Choices',
  components: { CreateChoice, Choice },
  props: [
    'user_role',
    'user_id',
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
        })
        .catch(() => {
          this.$emit('error', 'erreur chargement des choix');
        });
    },
  },
};
</script>
