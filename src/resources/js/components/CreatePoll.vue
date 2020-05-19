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
      required
    />

    <v-text-field
      v-model="inputChoice.choice1"
      :rules="choiceRules"
      label="choix 1"
      required
    />

    <v-text-field
      v-model="inputChoice.choice2"
      :rules="choiceRules"
      label="choix 2"
      required
    />

    <v-text-field
      v-model="inputChoice.choice3"
      :rules="choiceRules"
      label="choix 3"
      required
    />

    <v-text-field
      v-model="inputChoice.choice4"
      :rules="choiceRules"
      label="choix 4"
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
      choiceRules: [
        (v) => !!v || 'Il faut remplir les quatre choix',
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

          window.axios
            .all([
              window.axios.post(apiUrl, { message: this.inputChoice.choice1 }),
              window.axios.post(apiUrl, { message: this.inputChoice.choice2 }),
              window.axios.post(apiUrl, { message: this.inputChoice.choice3 }),
              window.axios.post(apiUrl, { message: this.inputChoice.choice4 }),
            ])
            .then(
              window.axios.spread(() => {
                alert.showMessage('success', 'Les choix du sondage ont été créés');
              }),
            )
            .catch(() => {
              alert.showMessage('error', 'Problème lors de la création du sondage');
            });
        })
        .catch(() => {
          alert.showMessage('error', 'Problème lors de la création du sondage');
        });
    },
  },
};
</script>
