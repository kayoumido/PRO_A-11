<template>
  <div id="app">
  
    <p class="title">PAUL</p>

    <!-- make this a form -->
    <div class="row">
      <button :style="{background: lightBlue}">Nom utilisateur</button>
    </div>


    <!-- make this a form -->
    <div class="row">
      <button :style="{background: lightBlue}">Mot de passe</button>
    </div>
  
    <div class="row">
      <button @click="redirect" :style="{background: darkBlue}">Se connecter</button>
    </div>
  </div>
</template>

<script>
    export default {
    name : 'Authentication',
    data () {
        return{
      darkBlue: '#5F74E8',
      lightBlue: '#69A7FF'}

    },
    methods: {
      redirect() {
        //it should route to the correct place
      },
      
    }
    }
</script>

<style scoped>
/* Roboto police doesn't exist in this project */

.title{
  margin: auto;
  font-family: Roboto;
  font-size: 64px;
  line-height: 200px;
  text-align: center;

  color: #8575FF;
}


.button {
  margin: auto;
  border: none;
  background-color: #000000;
  color: white;
  width: 409px;
  height: 99px;
  font-family: Roboto;
  font-size: 36px;
  border-radius: 5px;
}

.row {
  padding: 10px;
  display: flex;
  width: 100%;
}

</style>