<template>
    <v-card>
        <v-card-title v-if="user_role !== 'presenter'">{{poll.subject}}</v-card-title>
        <v-card-title v-else>
            <EditableText
                :value="poll.subject"
                name="subject"
                :api-url="`/polls/${poll.id}`"></EditableText>
            <v-btn @click="deletePoll" text color="error">
                <v-icon>mdi-delete</v-icon>
            </v-btn>
            <v-btn @click="submitPoll" v-show="poll.status === 'draft'" text color="success">
                <v-icon>mdi-cloud-upload</v-icon>
            </v-btn>
        </v-card-title>
        <Choices
            :user_role="user_role"
            :poll_id="poll.id"
            class="px-2"></Choices>
    </v-card>
</template>

<script>
import EditableText from './EditableText';
import Choices from './Choices';

let alert = {};
export default {
  name: 'Poll',
  components: { Choices, EditableText },
  props: [
    'poll',
    'user_id',
    'user_role',
  ],
  beforeMount() {
    alert = this.$parent.$parent.parentRefs.alert;
  },
  methods: {
    deletePoll() {
      const pollList = this.$parent;
      window.axios.delete(`/polls/${this.poll.id}`)
        .then(() => {
          pollList.refreshPolls();
        })
        .catch(() => {
          alert.showMessage('error', 'Une erreur est survenue lors de la suppresion du sondage');
        });
    },
    submitPoll() {
      window.axios.put(`/polls/${this.poll.id}/publish`)
        .then((response) => {
          this.poll = response.data;
        })
        .catch(() => {
          alert.showMessage('error', 'Une erreur est survenue lors de la publication du sondage');
        });
    },
  },
};
</script>
