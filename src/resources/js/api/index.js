import { Server, Model } from 'miragejs';

export default function makeServer({ environment = 'development' } = {}) {
  const server = new Server({
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
        const id = request.params.id;

        return schema.users.find(id);
      });
      
      /**
       * Here we define a route to handle put request 
       * This will simply update the user in with id 
       * with the data send in params
       */
      this.put("/user/:id", (schema, request) => {
        
        const id = request.params.id;
        const newAttrs = JSON.parse(request.requestBody)

        const user = schema.users.find(id)

        return user.update(newAttrs)
      })
    },
  });

  return server;
}
