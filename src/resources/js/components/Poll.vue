<template>
    <v-card>
        <v-card-title v-if="user_role !== 'presenter'">{{poll.subject}}</v-card-title>
        <v-card-title v-else>
            <EditableText
                :value="poll.subject"
                name="subject"
                :api-url="`/polls/${poll.id}`"></EditableText>
        </v-card-title>
        <v-card-actions>Put here the choices</v-card-actions>
    </v-card>
</template>

<script>
import EditableText from './EditableText';

export default {
  name: 'Poll',
  components: { EditableText },
  props: [
    'poll',
    'user_id',
    'user_role',
  ],
  mounted() {
    // eslint-disable-next-line no-console
    console.log(`Role: ${this.user_role}`);
  },
};
</script>
