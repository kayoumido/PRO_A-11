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

      <v-menu
        v-model="dateMenu"
        :close-on-content-click="false"
        :nudge-right="40"
        transition="scale-transition"
        offset-y
        min-width="290px"
      >
        <template v-slot:activator="{ on }">
          <v-text-field
            v-model="dataForm.date"
            label="Choisir une date"
            :rules="dateRules"
            required
            readonly
            v-on="on"
          />
        </template>
        <v-date-picker v-model="dataForm.date" @input="menu = false" />
      </v-menu>

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
import axios from 'axios';

// set Bearer token in header of the future request
axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

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
      date: new Date().toISOString().substr(0, 10),
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
    // get logged user info
    axios
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
      const apiUrl = `api/v1/users/${this.loggedUser.data.id}/presentations`;

      if (!this.$refs.form.validate()) {
        return;
      }

      // send http request with axios and catch response or error
      axios.post(apiUrl, this.dataForm)
        .then((response) => {
          this.showMessage('success', `La presentation ${response.data.data.title} a été correctement crée`);
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
