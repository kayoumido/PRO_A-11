<template>
  <div class="container">
    <h2>My Account</h2>

    <div v-if="showMessage" class="error">
      <h3>{{ message }}</h3>
    </div>

    <form @submit.prevent="submitChange()">
      <label for="UpdateFirstName">
        <input v-model="updateUserInfo.fname" type="text" :placeholder="this.loggedUser.fname" />
      </label>
    
      <label for="UpdateLastName">
        <input v-model="updateUserInfo.lname" type="text" :placeholder="this.loggedUser.lname" />
      </label>

      <label for="updateEmail">
        <input v-model="updateUserInfo.email" type="text" :placeholder="this.loggedUser.email" />
      </label>

      <label for="updatePassword">
        <input v-model="updateUserInfo.password" type="password" placeholder="New Password" />
      </label>

      <input type="submit" value="update information" />
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
      /** will use parent data when available (eg. parent.data.user) 
       * for now this is the current user logged
       */ 
      loggedUser: {
        id: 3,
        fname: 'Jane',
        lname: 'Doe',
        email: 'jane@paul.lo'
      },
      updateUserInfo: {
        fname: '',
        lname: '',
        email: '',  
        password: ''
      },
      message: '',
      showMessage: false
    };
  },
  methods: {
    submitChange() {
      const apiUrl = '/api/user/' + this.loggedUser.id;

      /**
       * wrapped Object.prototype for futur use
       * https://eslint.org/docs/rules/no-prototype-builtins
       */ 

      const has = Object.prototype.hasOwnProperty;

      // prepare the data to send

      const data = this.getDataToSend();

      /**
       * Check if the object is Empty
       * source : https://stackoverflow.com/questions/679915/how-do-i-test-for-an-empty-javascript-object
       */
      if(Object.keys(data).length === 0){
        this.showMessage = true;
        this.message = 'you must fill at least one field';
        return;
      }

      /* validate the email if there is 
       * https://www.geeksforgeeks.org/how-to-check-a-key-exists-in-javascript-object/
       *  
       */ 
      
      if(has.call(data,'email')){
        if(!this.ValidateEmail(data.email)){
          this.showMessage = true;
          this.message = 'You have entered an invalid email address!';
          return;
        }
      }

      // send http request with axios and catch response or error
      axios.put(apiUrl, data)
        .then(response => {

          this.loggedUser.fname = response.data.user.fname;
          this.loggedUser.lname = response.data.user.lname;
          this.loggedUser.email = response.data.user.email;

          this.showMessage = true;
          this.message = 'update successfull';

          this.cleanForm();
        })
        .catch(errorResponse => {
          this.showMessage = true;
          this.message = 'error while sending data';
        });
    },

    getDataToSend(){
      let data = {};

      // we add the key and value if user has change the field

      if(!this.isEmpty(this.updateUserInfo.fname)){
        data.fname = this.updateUserInfo.fname;
      }

      if(!this.isEmpty(this.updateUserInfo.lname)){
        data.lname = this.updateUserInfo.lname;
      }

      if(!this.isEmpty(this.updateUserInfo.email)){
        data.email = this.updateUserInfo.email;
      }

      if(!this.isEmpty(this.updateUserInfo.password)){
        data.password = this.updateUserInfo.password;
      }

      return data;
    },

    cleanForm (){
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
     **/ 
    ValidateEmail(inputMail) {
      const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,})+$/;

      return (inputMail.match(mailformat))
      
    }
  }
};
</script>