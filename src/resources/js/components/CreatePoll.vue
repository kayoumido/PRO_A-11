<template>

  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="inputPoll.subject"
      :rules="subjectRules"
      label="Thème"
    />

    <v-text-field
      v-model="inputChoice.choice1"
      label="choix 1"
    />

    <v-text-field
      v-model="inputChoice.choice2"
      label="choix 2"
    />

    <v-text-field
      v-model="inputChoice.choice3"
      label="choix 3"
    />

    <v-text-field
      v-model="inputChoice.choice4"
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
      inputPoll: {
        subject: '',
      },
      inputChoice: {
        choice1: '',
        choice2: '',
        choice3: '',
        choice4: '',
      },
    };
  },
  beforeMount() {
    alert = this.parentRefs.alert;
  },
  methods: {
    createPoll() {
      let apiUrl = `presentations/${this.$route.params.idPresentation}/polls`;

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, {
        subject: this.inputPoll.subject,
      })
        .then((response) => {
          alert.showMessage('success', 'Sondage créé');
          apiUrl = `polls/${response.data.id}/choices`;
        })
        .catch(() => {
          alert.showMessage('error', 'Problème lors de la création du sondage');
        });

      const requestChoice1 = window.axios.post(apiUrl, this.inputChoice.choice1);
      const requestChoice2 = window.axios.post(apiUrl, this.inputChoice.choice2);
      const requestChoice3 = window.axios.post(apiUrl, this.inputChoice.choice3);
      const requestChoice4 = window.axios.post(apiUrl, this.inputChoice.choice4);

      window.axios
        .all([requestChoice1, requestChoice2, requestChoice3, requestChoice4])
        .then(
          window.axios.spread(() => {
            alert.showMessage('success', 'Les choix du sondage ont été créés');
          }),
        )
        .catch(() => {
          alert.showMessage('error', 'Problème lors de la création du sondage');
        });
    },
  },
};
</script>
