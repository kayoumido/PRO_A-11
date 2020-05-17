<template>
    <v-alert
        v-model="message.show"
        :class="message.type"
        dismissible
    >
        {{ message.content }}
    </v-alert>
</template>

<script>
export default {
  name: 'AlertMessage',
  data() {
    return {
      message: {
        show: false,
        content: '',
        type: '',
      },
    };
  },
  methods: {
    showMessage(type, content) {
      this.message.show = true;
      this.message.content = content;
      this.message.type = type;
    },
  },
};
</script>
