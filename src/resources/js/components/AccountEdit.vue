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

    <v-text-field
      v-model="updateUserInfo.password"
      :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
      :type="showPassword ? 'text' : 'password'"
      label="Mot de passe"
      value=""
      class="input-group--focused"
      @click:append="showPassword = !showPassword"
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
import axios from 'axios';

// set Bearer token in header of the future request
axios.defaults.headers.common = { Authorization: `Bearer ${localStorage.getItem('Authorization-token')}` };

export default {
  name: 'AccountEdition',
  data() {
    return {
      // vuetify
      valid: true, // if a rules is not fully satisfied this will disable submit button
      nameRules: [
        (v) => v === '' || v.length <= 10 || 'Le nom doit contenir moins de 10 caractères',
      ],
      emailRules: [
        (v) => v === '' || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'l\'E-mail doit être valide',
      ],
      showPassword: false,
      // object for message management
      message: {
        show: false,
        content: '',
        type: '',
      },
      /*
       * For now LoggedUser is the current user logged info
       * this will serve as temporary test and debug value
       */
      loggedUser: {
        // id: 3,
        // fname: 'Jane',
        // lname: 'Doe',
        // email: 'jane@paul.lo',
      },
      // Object for form field binding
      updateUserInfo: {
        fname: '',
        lname: '',
        email: '',
        password: '',
      },
    };
  },
  beforeMount() {
    // get logged user info
    axios
      .get('/api/v1/me')
      .then((response) => {
        this.loggedUser = response.data.data;
      })
      .catch((error) => {
        this.showMessage('error', `La recupération des donnée utilisateur a échoué: ${error}`);
      });
  },
  methods: {
    submitChange() {
      // API Url use mirageJS for testing,
      const apiUrl = `/api/user/${this.loggedUser.id}`;
      // real backend
      // const apiUrl = `/api/v1/users/${this.loggedUser.id}`;

      // prepare the data to send
      const data = this.getDataToSend();

      // Check if the object is Empty

      if (Object.keys(data).length === 0) {
        this.showMessage('error', 'Vous devez remplir au moins un champs');
        return;
      }

      // send http request with axios and catch response or error
      axios.put(apiUrl, data)
        .then((response) => {
          this.loggedUser.fname = response.data.user.fname;
          this.loggedUser.lname = response.data.user.lname;
          this.loggedUser.email = response.data.user.email;

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
      if (!this.isEmpty(this.updateUserInfo.password)) {
        data.password = this.updateUserInfo.password;
      }
      return data;
    },
    cleanForm() {
      this.updateUserInfo.fname = '';
      this.updateUserInfo.lname = '';
      this.updateUserInfo.email = '';
      this.updateUserInfo.password = '';
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
