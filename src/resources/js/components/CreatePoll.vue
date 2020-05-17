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

    <v-text-field
      v-model="createPoll.choice1"
      label="choix 1"
    />

    <v-text-field
      v-model="createPoll.choice2"
      label="choix 2"
    />

    <v-text-field
      v-model="createPoll.choice3"
      label="choix 3"
    />

    <v-text-field
      v-model="createPoll.choice4"
      label="choix 4"
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
        choice1: '',
        choice2: '',
        choice3: '',
        choice4: '',
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
        })
        .catch((errorResponse) => {
          alert.showMessage('error', `Problème lors de la création du sondage`);
        });

      Window.axios.get(apiUrl, data)
        .then((response) => {
          apiUrl = 'polls/${this.response.id}/choices'
        })
        .catch((errorResponse) => {
          alert.showMessage('error', `Problème lors de la création du sondage`);
        });

      Window.axios.post(apiUrl, data)
        .then((response) => {
          const pollId = response.id;
        })
        .catch((errorResponse) => {
          alert.showMessage('error', `Problème lors de la création du sondage`);
        });


    },
  },
};
</script>
