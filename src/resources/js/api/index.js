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
        password : 'pass1234'
      });
      srv.create('user', {
        id: 2,
        fname: 'John',
        lname: 'Doe',
        email: 'john@paul.lo',
        password : 'pass1234'
      });
      srv.create('user', {
        id: 3,
        fname: 'Jane',
        lname: 'Doe',
        email: 'jane@paul.lo',
        password : 'pass1234'
      });
    },

    routes() {
      this.namespace = 'api';

      this.get('/user/:id', (schema, request) => {
        const id = request.params.id;

        return schema.users.find(id);
      });

      this.post('/login', (schema, request) => {
        let json = JSON.parse(request.requestBody);
        const email = json.email;
        const password = json.password;
        const user = schema.users.findBy({email: email});
        
         if(password === user.password){//should be hashed
          const response = {
            passed: true,
            token: 1
          };
           return response;
         } else {
           return new Response(401);
         }

      });
    },
  });

  return server;
}
