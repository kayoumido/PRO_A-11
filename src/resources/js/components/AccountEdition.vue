<template>
  <div class="container">
    <h2>My Account</h2>

    <div v-if="showMessage" class="error">
      <h3>{{ message }}</h3>
    </div>

    <form @submit.prevent="updateFirstName()">
      <label for="updateUsername">
        <input v-model="updateUser.fname" type="text" :placeholder="this.User.fname" />
      </label>

      <input type="submit" value="update firstname" />
    </form>

    <form @submit.prevent="updateLastName()">
      <label for="updateUsername">
        <input v-model="updateUser.lname" type="text" :placeholder="this.User.lname" />
      </label>

      <input type="submit" value="update lastname" />
    </form>

    <form @submit.prevent="updateEmail()">
      <label for="updateEmail">
        <input v-model="updateUser.email" type="email" :placeholder="this.User.email" />
      </label>

      <input type="submit" value="update email" />
    </form>

    <form @submit.prevent="updatePassword()">
      <label for="updatePassword">
        <input v-model="updateUser.password" type="password" placeholder="New Password" />
      </label>

      <input type="submit" value="update password" />
    </form>
  </div>
</template>

<script>
import axios from 'axios';
import router from '../routes';

export default {
  name: 'AccountEdition',
  props: ['parent'],
  data() {
    return {
      // will use parent data when available (eg. parent.data.user)
      User: {
        id: 3,
        fname: 'Jane',
        lname: 'Doe',
        email: 'jane@paul.lo'
      },
      updateUser: {
        fname: '',
        lname: '',
        email: '',  
        password: ''
      },
      message: '',
      showMessage: false,
    };
  },
  methods: {
    submitChange(data) {
      const apiUrl = '/api/user/' + this.User.id;
      // send http request with axios and catch response or error
      axios
        .put(apiUrl, data)
        .then(response => {

          this.User.fname = response.data.user.fname;
          this.User.lname = response.data.user.lname;
          this.User.email = response.data.user.email;

          this.showMessage = true;
          this.message = 'update successfull';

        })
        .catch(errorResponse => {
          this.showMessage = true;
          this.message = 'error while sending data';
        });
    },

    isEmpty(textInput) {
      if (textInput === ''){
        this.showMessage = true;
        this.message = 'you cannot submit empty change';
        return true;
      }
      
      return false;
      
    },
    /**
     * Return a boolean value if the input mail match the regex
     * source : https://www.w3resource.com/javascript/form/email-validation.php
     **/ 
    ValidateEmail(inputMail) {
      const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

      if(inputMail.match(mailformat))
      {
        return true;
      }

      this.showMessage = true;
      this.message = 'You have entered an invalid email address!'
      
      return false;
    },

    // call the submit function according to the data that the user would change

    updateFirstName() {
      if (!this.isEmpty(this.newFirstName)) {

        this.submitChange({
          fname: this.newFirstName
        });
        this.newFirstName = '';
      }
    },
    updateLastName() {
      if (!this.isEmpty(this.newLastName)) {

        this.submitChange({
          lname: this.newLastName
        });
        // clean the form
        this.newLastName = '';
      }
    },

    updateEmail() {
      if (!this.isEmpty(this.newEmail) && this.ValidateEmail(this.updateUser.email)) {

        this.submitChange({
          email: this.newEmail
        });

        // clean the form
        this.newEmail = '';
      }
    },
    updatePassword() {
      if (!this.isEmpty(this.newPassword)) {

        this.submitChange({
          password: this.newPassword
        });
        // clean the form
        this.newPassword = '';
      }
    }
  }
};
</script>