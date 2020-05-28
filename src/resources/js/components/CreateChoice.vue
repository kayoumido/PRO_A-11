<template>
    <v-sheet
        class="pa-12"
        elevation="3"
        color="grey lighten-2">
        <v-list-item-content>
            <v-list-item-title>
                <v-text-field
                    v-model="input.message"
                    :rules="[rules.required]"
                    name="message"
                    placeholder="Nouveau Choix">
                </v-text-field>
            </v-list-item-title>
        </v-list-item-content>
        <v-list-item-action>
            <v-btn @click="createChoice" text small color="success">
                Nouveau Choix
            </v-btn>
        </v-list-item-action>
    </v-sheet>
</template>

<script>
export default {
  name: 'CreateChoice',
  props: [
    'poll_id',
  ],
  data() {
    return {
      rules: {
        required: (v) => !!v || 'Champ requis',
      },
      error: false,
      input: {
        message: '',
      },
    };
  },
  methods: {
    createChoice() {
      window.axios.post(`/polls/${this.poll_id}/choices`, this.input)
        .then(() => {
          this.error = false;
          this.input.message = '';
          this.$emit('update-choices');
        })
        .catch(() => {
          this.error = true;
          this.$emit('error', 'erreur lors de la creation du choix');
        });
    },
  },
};
</script>
