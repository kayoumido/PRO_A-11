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
      const { alert } = this.$parent.$parent.$parent.parentRefs;
      const apiUrl = `/presentations/${this.presentation_id}/polls`;

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, this.input)
        .then(() => {
          this.input.subject = '';
          this.error = false;
          this.$parent.refreshPolls();
        })
        .catch(() => {
          this.error = true;
          alert.showMessage('error', 'Problème lors de la création du sondage');
        });
    },
  },
};
</script>
