<template>
  <div class="container">

    <form @submit.prevent="updateUsername()">
   
      <label for="updateUsername">
        <input v-model="newUserName" type="text" placeholder="New username" />
      </label>

      <input type="submit" value="update username" />
    </form>

    <form @submit.prevent="updateEmail()">
   
      <label for="updateEmail">
        <input v-model="newEmail" type="new Email" placeholder="New E-mail" />
      </label>

      <input type="submit" value="update email" />
    </form>

    <form @submit.prevent="updatePassword()">
  
      <label for="updatePassword">
        <input v-model="newPassword" type="new Password" placeholder="New Password" />
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
  props: ['parent'],
  data() {
    return {
      newUserName: '',
      newPassword: '',
      newEmail: ''
    };
  },
  methods: {
    submitChange(data){
      // send http request and catch response or error 
      axios.put("/user",data)
        .then(response => {

            console.log(response);
            // apply the changes to the parent data
            this.$router.replace({name:'/'})
        })
        .catch(errorResponse => {
            console.log(errorResponse);
        });

    },
    updateUsername() {
      // send PUT request to apply theses change with axios
      this.submitChange({
        name : this.$parent.username,
        email : this.newUserName
      });
        
    },
    updateEmail() {
      this.submitChange({
        name : this.$parent.username,
        email : this.newEmail
      });
    },
    updatePassword() {
      this.submitChange({
        name : this.$parent.username,
        email : this.newPassword
      });
    }
    
  }
};
</script>

<style>
</style>