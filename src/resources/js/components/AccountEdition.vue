<template>
  <div class="container">
    <h2>My Account</h2>

    <div v-if="emptySubmit" class="error">
      <h3>you cannot submit empty change</h3>
    </div>

    <div v-if="errorHttp" class="error">
      <h3>error while sending data</h3>
    </div>

    <form @submit.prevent="updateFirstName()">
      <label for="updateUsername">
        <input v-model="newFirstName" type="text" :placeholder="this.User.fname" />
      </label>

      <input type="submit" value="update firstname" />
    </form>

    <form @submit.prevent="updateLastName()">
      <label for="updateUsername">
        <input v-model="newLastName" type="text" :placeholder="this.User.lname" />
      </label>

      <input type="submit" value="update lastname" />
    </form>

    <form @submit.prevent="updateEmail()">
      <label for="updateEmail">
        <input v-model="newEmail" type="email" :placeholder="this.User.email" />
      </label>

      <input type="submit" value="update email" />
    </form>

    <form @submit.prevent="updatePassword()">
      <label for="updatePassword">
        <input v-model="newPassword" type="password" placeholder="New Password" />
      </label>

      <input type="submit" value="update password" />
    </form>
  </div>
</template>

<script>
import axios from "axios";
import router from "../routes";

export default {
  name: "AccountEdition",
  props: ["parent"],
  data() {
    return {
      // will use parent data when available (eg. parent.data.user)
      User: {
        id: 3,
        fname: "Jane",
        lname: "Doe",
        email: "jane@paul.lo"
      },
      newFirstName: '',
      newLastName: '',
      newPassword: '',
      newEmail: '',
      emptySubmit: false,
      errorHttp: false
    };
  },
  methods: {
    submitChange(data) {
      const apiUrl = "/api/user/" + this.User.id;
      // send http request with axios and catch response or error
      axios
        .put(apiUrl, data)
        .then(response => {
          console.log(response);
          this.User = response.data.user;
        })
        .catch(errorResponse => {
          this.errorHttp = true;
          console.log(errorResponse);
        });
    },

    isEmpty(textInput) {
      // if (textInput === "") {
      //   this.emptySubmit = true;
      // } else {
      //   this.emptySubmit = false;
      // }

      this.emptySubmit = (textInput === "");

      return this.emptySubmit;
      
    },

    // call the submit function according to the data that the user would change

    updateFirstName() {
      if (!this.isEmpty(this.newFirstName)) {

        this.submitChange({
          fname: this.newFirstName
        });
        this.newFirstName = "";
      }
    },
    updateLastName() {
      if (!this.isEmpty(this.newLastName)) {

        this.submitChange({
          lname: this.newLastName
        });
        // clean the form
        this.newLastName = "";
      }
    },

    updateEmail() {
      if (!this.isEmpty(this.newEmail)) {

        this.submitChange({
          email: this.newEmail
        });

        // clean the form
        this.newEmail = "";
      }
    },
    updatePassword() {
      if (!this.isEmpty(this.newPassword)) {

        this.submitChange({
          password: this.newPassword
        });
        // clean the form
        this.newPassword = "";
      }
    }
  }
};
</script>