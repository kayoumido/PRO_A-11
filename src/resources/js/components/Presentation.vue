<template>
  <div class="container">

     <div v-for="(value, name) in presentation" :key="name">
          {{ name }} : {{ value }}
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
               presentation : {}
          }
     },
     beforeMount () {
          this.getPresentationInfo();
     },
     methods : {
          getPresentationInfo(){

               const apiUrl = 'api/v1/presentations/1' /*idPresentation*/;
               
               axios.get(apiUrl)
                    .then((response) =>{
                         this.presentation = response.data.data;
                    })
                    .catch((error) => {
                         console.log(error);
                    })

          }
     }


}
</script>