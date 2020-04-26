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

      this.post('/v1/login', (schema, request) => {
        let json = JSON.parse(request.requestBody);
        const email = json.email;
        const password = json.password;
        const user = schema.users.findBy({email: email});
        
         if(password === user.password){//should be hashed
          const response = {
            token_type:'Bearer',
            expires_in:31536000,
            access_token:'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI0IiwianRpIjoiOTE1NjhjODM5ZDUyMGY5N2YxMDA0ZGMwYmFlOTlmNTZiOTc3NmI2MzY0YzhlOTYxN2JiYmU3ODc4M2I2ZGIxNmJhNDIyZTg2NzI1ODExNGYiLCJpYXQiOjE1ODc4NDMzMTgsIm5iZiI6MTU4Nzg0MzMxOCwiZXhwIjoxNjE5Mzc5MzE4LCJzdWIiOiIyNCIsInNjb3BlcyI6W119.SJX_vN41Pzw4vMBcpfh48vK1jfBIbbT0Y9dxuwooBsP3Benm9dJq2fpTGrHZ6_EJn40TPuEpOjbZwh05cU7MZeUB2vvcwulygfEjUPg6VuVf00M2WawhJjnk1IqnN9VM87KJm3UM0BDl1pNscAoEAHUIUhyc4t83fqfinZF0gJCzeG3TyHjCnW1MQO3GC7GWCvqSfukzdXbJIaTz5yIiTQFg20nR1QCF2rQxTsBJ6sG2k9VmoqV9xW-_rIMGv0pzB1iIcJ2YWI-om_LAux5frN49UhuFZaott4qJwuLC4scTtrB2QZcXmVhzPf78RlS4iyL7JBYuXbhNK8JcD3SjtXYYKhWw9f9Vpj-Wvopmp9VBLutLkIxTUaUy1yhmh3_Ae7FPYPQTZGWSTXBSCGKaLE0Z3Mp4q0fvDskXr4IyLxQXQf3WJuC5WgAkc7ewt13nPEy79vEGYD0FNQ41ksRUkDmxFwe7_S51jXYZ72bZNp2FnNZ6tBHXXfow5lY4tw5MQ-WAdqunnTwQAi_1ppRL3z-n9OkmIrCdSXXbvCSfbsUS6Aoft0wpwxlNs2Po_Aq-5qBvOAsIBc_DCM431CI8kZ9WO41ElxEviSFdhUxqlX9z2UBbtPy32_frue5vLtAjbmGBITa2yirefVcsdNvD1e0vYPEta2L2bBIPNb0Ka6o',
            refresh_token:'def502009814d3c7c03d6dcbd0f65709fc858ed04d42d5053f90fdc0789d30f927d716d7de2305bca224a19a43db44213b71dfac03bf17d26b9d262c25beca9b4f144d5d5fe34e73099be88c296b25ccfb1a8c1e07aa96b0d69d69faf6053077a958d6aab9859a73c23efe56303a076489344fecacf94d37924a6870e04a339cb2102fb356a81df26639f2db36ea01cccd9f82f8bc3990c16cb058f8f0adf13c47d3f249367c0155a3d81e38234189009d21bfb09bdd0b0de328684a711351055b20aa11bbc9a4b3d26e0ee5a37d756328d2d2229db09a5f0a2b9d233a51922e4d1969ee20612c35216726b941bff33b27ed99479be5870f69475ef16dd4ca2334e25ff167dbacb6a34bb5c9a74164b439ef3d3ff9c76bf932ebeb696d65e70b8ffbf76532e13275eb2814b705ecd112fd883128e9a06fbb65110036ddda030639d09f8af3fea58c672584292558aeb07129e1b7db08fd4c6700833042f2f3c4230d'
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
