<template>
    <v-sheet
        class="pa-12"
        elevation="3"
        color="grey lighten-2">
        <div
            v-if="user_role !== 'presenter'"
            @click="vote">
            {{choice.message}}
        </div>
        <div v-else>
            <EditableText
                :value="choice.message"
                name="message"
                :api-url="`/choices/${choice.id}`"></EditableText>
            <v-btn @click="deleteChoice" text color="error">
                <v-icon>mdi-delete</v-icon>
            </v-btn>
        </div>
    </v-sheet>
</template>

<script>
import EditableText from './EditableText';

export default {
  name: 'Choice',
  components: { EditableText },
  props: [
    'choice',
    'user_role',
    'user_id',
    'poll_id',
  ],
  methods: {
    deleteChoice() {
      window.axios.delete(`/choices/${this.choice.id}`)
        .then(() => {
          this.$parent.refreshChoices();
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log('erreur de suppression de choix', error);
        });
    },
    vote() {
      window.axios.post(`/polls/${this.poll_id}/users/${this.user_id}`, {
        choice_id: this.choice.id,
      })
        .then(() => {
          this.$parent.refreshChoices();
        })
        .catch((error) => {
          // eslint-disable-next-line no-console
          console.log('erreur de vote', error);
        });
    },
  },
};
</script>

<style scoped>

</style>
