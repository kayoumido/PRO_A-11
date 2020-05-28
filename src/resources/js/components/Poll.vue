<template>
    <v-card class="pb-4">
        <v-card-title v-if="user_role !== 'presenter'">
            <CustomFont>
                {{poll.subject}}
            </CustomFont>
        </v-card-title>
        <v-card-title v-else>
            <v-list-item-content>
                <v-list-item-title
                    class="title">
                    <v-text-field
                        v-model="input"
                        :rules="[rules.required]"
                        @change="updateValue">
                    </v-text-field>
                </v-list-item-title>
            </v-list-item-content>
            <v-list-item-action v-show="poll.status === 'draft'">
                <v-btn @click="submitPoll" text color="success">
                    Publier
                </v-btn>
            </v-list-item-action>
            <v-list-item-action>
                <v-btn @click="deletePoll" text color="error">
                    Supprimer
                </v-btn>
            </v-list-item-action>
        </v-card-title>
        <Choices
            v-on:choice-done="poll.auth_user_choice = $event"
            v-on:error="$emit('error', $event)"
            v-if="user_role === 'presenter' || poll.auth_user_choice === 'none'"
            :user_role="user_role"
            :user_id="user_id"
            :poll_id="poll.id"
            class="px-2"></Choices>
        <PollResult
            v-on:error="$emit('error', $event)"
            v-else
            :poll_id="poll.id"></PollResult>
    </v-card>
</template>

<script>
import Choices from './Choices';
import PollResult from './PollResult';
import CustomFont from './layout/CustomFont';

export default {
  name: 'Poll',
  components: { CustomFont, PollResult, Choices },
  props: [
    'poll',
    'user_id',
    'user_role',
  ],
  data() {
    return {
      rules: {
        required: (value) => !!value || 'Required.',
      },
      input: this.poll.subject,
    };
  },
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
    updateValue() {
      window.axios.put(`/polls/${this.poll.id}`, {
        subject: this.input,
      })
        .then((response) => {
          this.input = response.data.subject;
        })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue lors de la mise à jour du sondage');
        });
    },
  },
};
</script>
