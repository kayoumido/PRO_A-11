<template>
  <div class="container">

    <form @submit.prevent="applyChange()">
   
      <label for="updateUsername">
        <input v-model="newUserName" type="text" placeholder="New username" />
      </label>

      <label for="updateEmail">
        <input v-model="newEmail" type="new Email" placeholder="New E-mail" />
      </label>

      <label for="updatePassword">
        <input v-model="newPassword" type="new Password" placeholder="New Password" />
      </label>

      <input type="submit" value="SubmitChange" />
    </form>
  </div>
</template>

<script>
import axios from "axios";
import router from "../routes";

export default {
  name: "AccountEdition",
  data() {
    return {
      newUserName: '',
      newPassword: '',
      newEmail: ''
    };
  },
  methods: {
    applyChange() {
      // send PUT request to apply theses change with axios

      axios
        .put("/user", {
          //name: this.parent.userLogged.name,
          email: this.newEmail,
          password: this.newPassword
        })
        .then(response => {
            console.log(response);
            // apply the changes to the parent data
            
        })
        .catch(errorResponse => {
            console.log(errorResponse);
        });
        
        // go back to MainPage
        this.$router.replace({name:'/'})
        // display a success box and clean the data
        
    }

  }
};
</script>

<style>
</style>