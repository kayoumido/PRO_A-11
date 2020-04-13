<template>
<div class="container">
  <h3>Hello</h3>
  <div class="text-center" style="margin: 20px 0px 20px 0px;">
    <span class="text-secondary">Hello world</span>
  </div>
</div>
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