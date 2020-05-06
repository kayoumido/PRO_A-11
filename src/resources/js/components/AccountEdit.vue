<template>
  <v-container>

  <v-alert
    v-model="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

  <h2>Mon Compte</h2>

  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="updateUserInfo.fname"
      :counter="10"
      :rules="nameRules"
      label="Prenom"
    />

    <v-text-field
      v-model="updateUserInfo.lname"
      :counter="10"
      :rules="nameRules"
      label="Nom"
    />

    <v-text-field
      v-model="updateUserInfo.email"
      :rules="emailRules"
      label="E-mail"
    />

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="submitChange"
    >
      Appliquer
    </v-btn>

  </v-form>

  </v-container>
</template>

<script>
export default {
  name: 'AccountEdition',
  data() {
    return {
      valid: true, // if a rules is not fully satisfied this will disable the submit button
      nameRules: [
        (v) => v === '' || v.length <= 10 || 'Le nom doit contenir moins de 10 caractères',
      ],
      emailRules: [
        (v) => v === '' || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'l\'E-mail doit être valide',
      ],
      // object for message management
      message: {
        show: false,
        content: '',
        type: '',
      },
      loggedUser: {},
      // Object for form field binding
      updateUserInfo: {
        fname: '',
        lname: '',
        email: '',
      },
    };
  },
  beforeMount() {
    // get logged user info
    window.axios
      .get('/api/v1/me')
      .then((response) => {
        this.loggedUser = response.data;
      })
      .catch((error) => {
        this.showMessage('error', `La recupération des donnée utilisateur a échoué: ${error}`);
      });
  },
  methods: {
    submitChange() {
      // API Url use mirageJS for testing data ,
      // const apiUrl = `/api/user/${this.loggedUser.id}`;

      // real backend URL
      const apiUrl = `/api/v1/users/${this.loggedUser.id}`;

      // prepare the data to send
      const data = this.getDataToSend();

      // Check if the object is Empty

      if (Object.keys(data).length === 0) {
        this.showMessage('error', 'Vous devez remplir au moins un champs');
        return;
      }

      // send http request with axios and catch response or error
      window.axios.put(apiUrl, data)
        .then((response) => {
          // real backend response
          this.loggedUser = response.data;

          // mirage response
          // this.loggedUser = response.data.user;
          this.showMessage('success', 'Changement appliqué');

          this.cleanForm();
        })
        .catch((errorResponse) => {
          this.showMessage('error', `Erreur lors de l'envoie des donnée ${errorResponse}`);
        });
    },
    /**
     * Prepare the data object for sending to the backend
     * add a key only if the field is not empty
     */
    getDataToSend() {
      const data = {};
      // we add the key and value if user has change the field
      if (!this.isEmpty(this.updateUserInfo.fname)) {
        data.fname = this.updateUserInfo.fname;
      }
      if (!this.isEmpty(this.updateUserInfo.lname)) {
        data.lname = this.updateUserInfo.lname;
      }
      if (!this.isEmpty(this.updateUserInfo.email)) {
        data.email = this.updateUserInfo.email;
      }

      return data;
    },
    cleanForm() {
      this.updateUserInfo.fname = '';
      this.updateUserInfo.lname = '';
      this.updateUserInfo.email = '';
    },
    isEmpty(textInput) {
      return (textInput === '');
    },
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
