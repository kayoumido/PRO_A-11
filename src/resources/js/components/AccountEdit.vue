<template>
  <v-container>

  <v-alert
    v-if="message.show"
    :class="message.type"
    dismissible
    >
      {{ message.content }}
    </v-alert>

  <h2>My Account</h2>

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
      v-model="updateUserInfo.fname"
      :counter="10"
      :rules="nameRules"
      label="firstName"
    ></v-text-field>

    <v-text-field
      v-model="updateUserInfo.lname"
      :counter="10"
      :rules="nameRules"
      label="lastName"
    ></v-text-field>

    <v-text-field
      v-model="updateUserInfo.email"
      :rules="emailRules"
      label="E-mail"
    ></v-text-field>

    <v-text-field
      v-model="updateUserInfo.password"
      :append-icon="show ? 'mdi-eye' : 'mdi-eye-off'"
      :type="show ? 'text' : 'password'"
      label="password"
      value=""
      class="input-group--focused"
      @click:append="show = !show"
    ></v-text-field>

    <v-btn
      :disabled="!valid"
      color="success"
      class="mr-4"
      @click="submitChange"
    >
      Submit
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
      // vuetify
      show: false,
      valid: true,
      name: '',
      nameRules: [
        (v) => (v === '' || v.length <= 10) || 'Name must be less than 10 characters',
      ],
      email: '',
      emailRules: [
        (v) => v === '' || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,})+$/.test(v) || 'E-mail must be valid',
      ],
      message: {
        show: false,
        content: '',
        type: '',
      },
      /** will use parent data when available (eg. parent.data.user)
       * for now this is the current user logged
       */
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
    };
  },
  methods: {
    // old
    submitChange() {
      const apiUrl = `/api/user/${this.loggedUser.id}`;

      // prepare the data to send
      const data = this.getDataToSend();

      // Check if the object is Empty

      if (Object.keys(data).length === 0) {
        this.showMessage('sucerrorcess', 'you must fill at least one field');
        return;
      }

      // send http request with axios and catch response or error
      axios.put(apiUrl, data)
        .then((response) => {
          this.loggedUser.fname = response.data.user.fname;
          this.loggedUser.lname = response.data.user.lname;
          this.loggedUser.email = response.data.user.email;

          this.showMessage('success', 'update successfull');

          this.cleanForm();
        })
        .catch((errorResponse) => {
          this.showMessage('error', `error while sending data ${errorResponse}`);
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
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
