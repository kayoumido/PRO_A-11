<template>
     <div class="container">
          <div v-if="isError" class="error">
               <h3> {{ message }} </h3>
               <div v-for="(value, name) in errorResponse" :key="name">
                    {{ name }} : {{ value }}
               </div>
          </div>

          <h3>Presentation info</h3>
     
          <div v-for="(value, name) in presentation" :key="name">
               {{ name }} : {{ value }}
          </div>
     
          <h3>Polls related</h3>

          <div v-for="poll in polls" :key="poll.id">
               {{ poll.id }} : {{ poll.subject }}
          </div>

     </div>

</template>

<script>
import axios from 'axios';

export default {
     name : 'Presentation',
     props : ['idPresentation'],
     data() {
          return {
               presentation : {},
               polls : [],
               isError : false,
               message : '',
          }
     },
     beforeMount () {
          this.getPresentationInfo();
     },
     methods : {
          getPresentationInfo() {
               
               //const id = idPresentation;
               const id = 1;
               const apiUrl = 'api/v1/presentations/aaa' + id;
               
               axios.get(apiUrl)
                    .then((response) =>{
                         this.presentation = response.data.data;
                    })
                    .catch((error) => {
                         this.isError = true;
                         this.message = 'error while sending data : ' + error.response.status;

                    })

          },
          getPollsRelated() { 
               // related to #112
               
          }

     }


}
</script>