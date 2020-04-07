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

<style>

</style>