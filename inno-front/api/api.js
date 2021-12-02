const axios = require('axios');

export async function auth(){
  return await axios.get('https://jsonplaceholder.typicode.com/posts');
}
