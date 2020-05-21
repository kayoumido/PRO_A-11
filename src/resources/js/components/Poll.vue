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
            v-on:choice-done="poll.auth_user_choice = $event"
            v-on:error="$emit('error', $event)"
            v-if="poll.auth_user_choice === 'none'"
            :user_role="user_role"
            :user_id="user_id"
            :poll_id="poll.id"
            class="px-2"></Choices>
        <PollResult
            v-else></PollResult>
    </v-card>
</template>

<script>
import EditableText from './EditableText';
import Choices from './Choices';
import PollResult from './PollResult';

export default {
  name: 'Poll',
  components: { PollResult, Choices, EditableText },
  props: [
    'poll',
    'user_id',
    'user_role',
  ],
  methods: {
    deletePoll() {
      window.axios.delete(`/polls/${this.poll.id}`)
        .then(() => {
          this.$emit('update-polls');
        })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue lors de la suppresion du sondage');
        });
    },
    submitPoll() {
      window.axios.put(`/polls/${this.poll.id}/publish`)
        .then((response) => {
          this.poll = response.data;
        })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue lors de la publication du sondage');
        });
    },
  },
};
</script>
