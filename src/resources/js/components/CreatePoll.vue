<template>
  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="input.subject"
      :rules="subjectRules"
      label="Thème"
      required
    />

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="createPoll"
    >
      Créer sondage
    </v-btn>

  </v-form>
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
  data() {
    return {
      valid: true,
      subjectRules: [
        (v) => !!v || 'Un sujet est nécessaire',
      ],
      // Object for form field binding
      input: {
        subject: '',
      },
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert;
  },
  methods: {
    createPoll() {
      const apiUrl = `presentations/${this.$route.params.idPresentation}/polls`;

      // force data validation
      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, {
        subject: this.input.subject,
      })
        .then(() => {
          alert.showMessage('success', 'Sondage créé');
        })
        .catch(() => {
          alert.showMessage('error', 'Problème lors de la création du sondage');
        });
    },
  },
};
</script>
