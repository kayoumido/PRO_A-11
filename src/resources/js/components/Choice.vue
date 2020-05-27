<template>
    <v-sheet
        class="pa-12"
        elevation="3"
        :color="(user_role !== 'presenter')? 'secondary' : 'grey lighten-2'"
        :dark="user_role !== 'presenter'">
        <div
            v-if="user_role !== 'presenter'"
            @click="vote">
            {{choice.message}}
        </div>
        <div v-else>
            <v-list-item-content>
                <v-list-item-title>
                    <v-text-field
                        v-model="input"
                        :rules="[rules.required]"
                        @change="updateValue">
                    </v-text-field>
                </v-list-item-title>
            </v-list-item-content>
            <v-list-item-action>
                <v-btn @click="deleteChoice" text small color="error">
                    Supprimer
                </v-btn>
            </v-list-item-action>
        </div>
    </v-sheet>
</template>

<script>

export default {
  name: 'Choice',
  props: [
    'choice',
    'user_role',
    'user_id',
    'poll_id',
  ],
  data() {
    return {
      rules: {
        required: (value) => !!value || 'Required.',
      },
      input: this.choice.message,
    };
  },
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
    updateValue() {
      window.axios.put(`/choices/${this.choice.id}`, {
        message: this.input,
      })
        .then((response) => {
          this.input = response.data.message;
        })
        .catch(() => {
          this.$emit('error', 'Une erreur est survenue lors de la mise à jour du choix');
        });
    },
  },
};
</script>
