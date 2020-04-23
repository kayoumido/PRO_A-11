<template>
  <v-container>
    <h2>My Account</h2>

    <div v-if="showMessage" class="error">
      <h3>{{ message }}</h3>
    </div>

    <!--form @submit.prevent="submitChange()">
      <label for="UpdateFirstName">
        <input id="UpdateFirstName" v-model="updateUserInfo.fname" type="text"
        placeholder="New firstname" />
      </label>

      <label for="UpdateLastName">
        <input id="UpdateLastName" v-model="updateUserInfo.lname" type="text"
        placeholder="New lastname"/>
      </label>

      <label for="updateEmail">
        <input  id="updateEmail" v-model="updateUserInfo.email" type="text"
        placeholder="New email"/>
      </label>

      <label for="updatePassword">
        <input id="updatePassword" v-model="updateUserInfo.password" type="password"
        placeholder="New password" />
      </label>

      <input type="submit" value="update information" />
    </form-->

  <v-form
    ref="form"
    v-model="valid"
    lazy-validation
  >
    <v-text-field
      v-model="name"
      :counter="10"
      :rules="nameRules"
      label="firstName"
    ></v-text-field>

    <v-text-field
      v-model="name"
      :counter="10"
      :rules="nameRules"
      label="lastName"
    ></v-text-field>

    <v-text-field
      v-model="email"
      :rules="emailRules"
      label="E-mail"
    ></v-text-field>

    <v-text-field
      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
      :type="show ? 'text' : 'password'"
      name="input-10-2"
      label="password"
      hint="At least 8 characters"
      value=""
      class="input-group--focused"
      @click:append="show = !show"
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="validate"
    >
      Validate
    </v-btn>

    <v-btn
      color="error"
      class="mr-4"
      @click="reset"
    >
      Reset Form
    </v-btn>

  </v-form>

  </v-container>
</template>

<script>
import axios from 'axios';

export default {
  name: 'AccountEdition',
  props: ['parent'],
  data() {
    return {
      /** will use parent data when available (eg. parent.data.user)
       * for now this is the current user logged
       */
      // vuetify
      show: false,
      valid: true,
      name: '',
      nameRules: [
        (v) => !!v || 'Name is required',
        (v) => (v && v.length <= 10) || 'Name must be less than 10 characters',
      ],
      email: '',
      emailRules: [
        (v) => !!v || 'E-mail is required',
        (v) => /.+@.+\..+/.test(v) || 'E-mail must be valid',
      ],
      // old
      loggedUser: {
        id: 3,
        fname: 'Jane',
        lname: 'Doe',
        email: 'jane@paul.lo',
      },
      updateUserInfo: {
        fname: '',
        lname: '',
        email: '',
        password: '',
      },
      message: '',
      showMessage: false,
    };
  },
  methods: {
    // vuetify
    validate() {
      this.$refs.form.validate();
    },
    reset() {
      this.$refs.form.reset();
    },
    // old
    submitChange() {
      const apiUrl = `/api/user/${this.loggedUser.id}`;
      /**
       * wrapped Object.prototype for futur use
       */
      const has = Object.prototype.hasOwnProperty;
      // prepare the data to send
      const data = this.getDataToSend();
      /**
       * Check if the object is Empty
       */
      if (Object.keys(data).length === 0) {
        this.showMessage = true;
        this.message = 'you must fill at least one field';
        return;
      }
      // validate the email if there is

      if (has.call(data, 'email')) {
        if (!this.ValidateEmail(data.email)) {
          this.showMessage = true;
          this.message = 'You have entered an invalid email address!';
          return;
        }
      }
      // send http request with axios and catch response or error
      axios.put(apiUrl, data)
        .then((response) => {
          this.loggedUser.fname = response.data.user.fname;
          this.loggedUser.lname = response.data.user.lname;
          this.loggedUser.email = response.data.user.email;
          this.showMessage = true;
          this.message = 'update successfull';
          this.cleanForm();
        })
        .catch((errorResponse) => {
          this.showMessage = true;
          this.message = `error while sending data ${errorResponse.response.status}`;
        });
    },
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
    /**
     * Return a boolean value if the input mail match the regex
     * source : https://www.w3resource.com/javascript/form/email-validation.php
     * */
    ValidateEmail(inputMail) {
      const mailformat = /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/;
      return (inputMail.match(mailformat));
    },
  },
};
</script>
