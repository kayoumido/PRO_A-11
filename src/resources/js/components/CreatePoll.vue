<template>
  <v-card>
      <v-card-title>
          <v-text-field
              v-model="input.subject"
              :rules="[rules.required]"
              name="subject"
              placeholder="Nouveau poll"
              :error="error">
          </v-text-field>
          <v-btn @click="createPoll" text color="success">
              <v-icon>mdi-file-plus-outline</v-icon>
          </v-btn>
      </v-card-title>
  </v-card>
</template>

<script>
export default {
  name: 'CreatePoll',
  props: [
    'presentation_id',
  ],
  data() {
    return {
      rules: {
        required: (v) => !!v || 'Un sujet est nécessaire',
      },
      // Object for form field binding
      input: {
        subject: '',
      },
      error: false,
    };
  },
  methods: {
    createPoll() {
      const apiUrl = `/presentations/${this.presentation_id}/polls`;

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, this.input)
        .then(() => {
          this.input.subject = '';
          this.error = false;
          this.$emit('update-polls');
        })
        .catch(() => {
          this.error = true;
          this.$emit('error', 'Problème lors de la création du sondage');
        });
    },
  },
};
</script>
