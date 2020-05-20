<template>
    <v-card>
        <v-card-title v-if="user_role !== 'presenter'">{{poll.subject}}</v-card-title>
        <v-card-title v-else>
            <EditableText
                :value="poll.subject"
                name="subject"
                :api-url="`/polls/${poll.id}`"></EditableText>
            <v-btn @click="deletePoll" text color="error"><v-icon>mdi-delete</v-icon></v-btn>
        </v-card-title>
        <v-card-actions>Put here the choices</v-card-actions>
    </v-card>
</template>

<script>
import EditableText from './EditableText';

export default {
  name: 'Poll',
  components: { EditableText },
  props: [
    'poll',
    'user_id',
    'user_role',
  ],
  methods: {
    deletePoll() {
      const pollList = this.$parent;
      const { alert } = pollList.$parent.$parent.parentRefs;
      window.axios.delete(`/polls/${this.poll.id}`)
        .then(() => {
          pollList.refreshPolls();
        })
        .catch(() => {
          alert.showMessage('error', 'Une erreur est survenue lors de la suppresion du sondage');
        });
    },
  },
};
</script>
