<template>
  <v-container>
    <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

    <h2>Creation de presentation</h2>
    <v-form
      ref="form"
      v-model="valid"
      lazy-validation
    >
      <v-text-field
        v-model="dataForm.title"
        :counter="20"
        :rules="titleRules"
        label="Titre"
        required
      />

      <v-datetime-picker
        label="Date et Heure"
        v-model="dataForm.date"
        :rules="dateRules"
      >
      </v-datetime-picker>

      <v-btn
        :disabled="!valid"
        color="success"
        class="mr-4"
        @click="createPresentation()"
      >
        Créer la présentation
      </v-btn>

    </v-form>
  </v-container>
</template>

<script>
export default {
  data: () => ({
    valid: true,
    titleRules: [
      (v) => !!v || 'Vous devez renseigner un titre',
      (v) => (v && v.length <= 20) || 'Le Nom doit contenir moins de 20 caractères',
    ],
    dateMenu: false,
    dateRules: [
      (v) => !!v || 'Vous devez renseigner une date',
    ],
    dataForm: {
      date: new Date(),
      title: '',
    },
    // object for message management
    message: {
      show: false,
      content: '',
      type: '',
    },
    loggedUser: {},

  }),
  beforeMount() {
    // set Bearer token in header of the future request
    window.axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };
    // get logged user info
    window.axios
      .get('/api/v1/me')
      .then((response) => {
        this.loggedUser = response.data;
      })
      .catch((error) => {
        this.showMessage('error', `Erreur lors de la recuperation des info: ${error}`);
      });
  },
  methods: {
    createPresentation() {
      const apiUrl = `/api/v1/users/${this.loggedUser.data.id}/presentations`;

      // force date validation
      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      window.axios.post(apiUrl, {
        title: this.dataForm.title,
        date: this.dataForm.date,
      })
        .then((response) => {
          this.showMessage('success', `La présentation ${response.data.data.title} a été correctement créée`);
          this.$refs.form.reset();
        })
        .catch((errorResponse) => {
          this.showMessage('error', `erreur lors de l'envoie des données ${errorResponse}`);
        });
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
<style>

</style>
