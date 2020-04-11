<template>
  <div class="container">
    <h2>My Account</h2>
    
    <div v-if="isBlank" class="error">
      <h3>you cannot submit empty change</h3>
    </div>
    
    <div v-if="errorHttp" class="error">
      <h3>error while sending data</h3>
    </div>

    <form @submit.prevent="updateUsername()">
   
      <label for="updateUsername">
        <input v-model="newUserName" type="text" placeholder="New username" required />
      </label>

      <input type="submit" value="update username" />
    </form>

    <form @submit.prevent="updateEmail()">
   
      <label for="updateEmail">
        <input v-model="newEmail" type="email" placeholder="New E-mail" required />
      </label>

      <input type="submit" value="update email" />
    </form>

    <form @submit.prevent="updatePassword()">
  
      <label for="updatePassword">
        <input v-model="newPassword" type="password" placeholder="New Password" required />
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
      currentUsername : 'PaulHochon', // will use parent data when available
      newUserName: '',
      newPassword: '',
      newEmail: '',
      isBlank : false,
      errorHttp : false
    };
  },
  methods: {
    submitChange(data){
      // send http request with axios and catch response or error 
      axios.put("/v1/api/user",data)
        .then(response => {
            console.log(response);

            if (data.newUsername != null){
              // if username has been update we adapte the CurrentUsername
              this.currentUsername = data.newUsername; 
            }

        })
        .catch(errorResponse => {
            this.errorHttp = true;
            console.log(errorResponse);
        });

    },
    // call the submit function according to the data that the user would change
    // we will need a value from the parent (from props or other)
    updateUsername() {
      if(this.newUserName != ''){
        this.submitChange({
          name : this.currentUsername,
          newUsername : this.newUserName
        });
      }else{
        isBlank = true;
      }
        
    },
    updateEmail() {
      if(this.newEmail != ''){
        this.submitChange({
          name : this.currentUsername,
          newEmail : this.newEmail
        });
      }else{
        isBlank = true;
      }
    },
    updatePassword() {
      if(this.newPassword != ''){
        this.submitChange({
          name : this.currentUsername,
          newPassword : this.newPassword
        });
      }else{
        isBlank = true;
      }
    }
    
  }
};
</script>