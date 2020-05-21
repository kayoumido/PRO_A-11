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
          this.$emit('update-choices');
        })
        .catch(() => {
          this.$emit('error', 'erreur de suppression de choix');
        });
    },
    vote() {
      window.axios.post(`/polls/${this.poll_id}/users/${this.user_id}`, {
        choice_id: this.choice.id,
      })
        .then(() => {
          this.$emit('choice-done', this.choice.id);
        })
        .catch(() => {
          this.$emit('error', 'problème lors du vote');
        });
    },
  },
};
</script>
