<template>

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
</template>

<script>
let alert = {};
export default {
  props: ['parentRefs'],
  data() {
    return {
      valid: true, // if a rules is not fully satisfied this will disable the submit button
      nameRules: [
        (v) => v === '' || v.length <= 10 || 'Le nom doit contenir moins de 10 caractères',
      ],
      emailRules: [
        (v) => v === '' || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'l\'E-mail doit être valide',
      ],
      // Object for form field binding
      updateUserInfo: {
        fname: '',
        lname: '',
        email: '',
      },
    };
  },
  beforeMount() {
    this.setLoggedUser();
    alert = this.parentRefs.alert;
  },
  methods: {
    submitChange() {
      // API Url use mirageJS for testing data ,
      // const apiUrl = `/api/user/${this.loggedUser.id}`;

      // real backend URL
      const apiUrl = `/users/${this.loggedUser.id}`;

      // prepare the data to send
      const data = this.getDataToSend();

      // Check if the object is Empty

      if (Object.keys(data).length === 0) {
        alert.showMessage('error', 'Vous devez remplir au moins un champs');
        return;
      }

      // send http request with axios and catch response or error
      window.axios.put(apiUrl, data)
        .then((response) => {
          // real backend response
          this.loggedUser = response.data;

          // mirage response
          // this.loggedUser = response.data.user;
          alert.showMessage('success', 'Changement appliqué');

          this.cleanForm();
        })
        .catch((errorResponse) => {
          alert.showMessage('error', `Erreur lors de l'envoie des donnée ${errorResponse}`);
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
  },
};
</script>
