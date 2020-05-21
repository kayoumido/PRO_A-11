<template>
    <v-sheet
        class="pa-12"
        elevation="3"
        color="grey lighten-2">
        <div v-if="user_role !== 'presenter'">
            {{choice.message}}
        </div>
        <div v-else>
            <EditableText
                :value="choice.message"
                name="message"
                :api-url="`/choices/${choice.id}`"></EditableText>
        </div>
    </v-sheet>
</template>

<script>
import EditableText from './EditableText';

export default {
  name: 'Choice',
  components: { EditableText },
  props: [
    'choice',
    'user_role',
  ],
};
</script>

<style scoped>

</style>
