<template>
  <div class="container">
    <div v-if="showMessage">
      <h3>{{ message }}</h3>
    </div>

    <div v-for="presentation in presentations" :key="presentation.id">
      <!--
        passing props to a router link
        source : https://dev.to/aligoren/passing-data-to-a-router-link-in-vuejs-2cb0
                https://router.vuejs.org/guide/essentials/named-routes.html
      -->
      <router-link
        :to="{ name : 'presentation', params : { idPresentation : presentation.id} }"
        >
        {{ presentation.title }}
      </router-link>
    </div>

    <router-view></router-view>
  </div>
</template>

<script>

import axios from 'axios';

export default {
  name: 'ListPresentations',
  props: ['parent'],
  data() {
    return {
      // we will use parent data when available
      loggedUser: {
        id: 1,
        fname: 'Jane',
        lname: 'Doe',
        email: 'Jane@paul.io',
      },
      presentations: [],
      showMessage: false,
      message: '',
    };
  },
  /**
   * beforeMount will be after the creation of the Vue
   * source : https://vuejs.org/v2/api/#beforeMount
   */
  beforeMount() {
    this.getPresentation();
  },
  methods: {
    getPresentation() {
      const apiUrl = `/api/v1/users/${this.loggedUser.id}/presentations`;

      axios
        .get(apiUrl)
        .then((response) => {
          this.presentations = response.data.data;
          if (this.presentationsIsEmpty()) {
            this.showMessage = true;
          }
        })
        .catch((error) => {
          this.showMessage = true;
          this.message = `error while sending data, code ${error.response.status}`;
        });
    },
    presentationsIsEmpty() {
      return (this.presentations.length === 0);
    },
  },
};

</script>
