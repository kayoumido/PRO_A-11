<template>
    <v-container>
        <h3>Hello</h3>
        <v-btn class="primary">test btn</v-btn>
        <div class="text-center">
            <span class="text--secondary">Hello world</span>
        </div>
    </v-container>
</template>

<script>
export default {
  data() {
    return {
      user: {},
    };
  },
  created() {
    axios.get('/api/user/1')
      .then(response => {
        this.user = response.data.user;
      });
  },
}
</script>
