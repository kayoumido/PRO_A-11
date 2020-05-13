<template>

  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="createPoll.subject"
      :rules="subjectRules"
      label="Thème"
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
      createPoll: {
        subject: '',
      },
    };
  },
  beforeMount() {
    this.setLoggedUser();
    alert = this.parentRefs.alert;
  },
  methods: {
    submitChange() {
      const data = this.updatePresentationInfo;
      const apiUrl = `presentations/${this.$route.params.idPresentation}/polls`;

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, data)
        .then((response) => {
          alert.showMessage('success', 'Sondage créé');
          this.$router.push({ name: 'Login' });
        })
        .catch((errorResponse) => {
          alert.showMessage('error', `Problème lors de la création du sondage`);
        });
    },
  },
};
</script>
