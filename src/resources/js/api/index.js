import { Server, Model } from 'miragejs';

export default function makeServer({ environment = 'development' } = {}) {
  return new Server({
    environment,
    models: {
      user: Model,
    },

    seeds(srv) {
      srv.create('user', {
        id: 1,
        fname: 'Shawn',
        lname: 'The Sheep',
        email: 'shaw@paul.lo',
      });
      srv.create('user', {
        id: 2,
        fname: 'John',
        lname: 'Doe',
        email: 'john@paul.lo',
      });
      srv.create('user', {
        id: 3,
        fname: 'Jane',
        lname: 'Doe',
        email: 'jane@paul.lo',
      });
    },

    routes() {
      this.namespace = 'api';

      this.get('/user/:id', (schema, request) => {
        const { id } = request.params;

        return schema.users.find(id);
      });

      // Allow unhandled requests on the current domain to pass through
      this.passthrough()
    },
  });
}
