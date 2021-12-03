const axios = require('axios');

const URL = 'http://innoapi.cyberbobs.xsph.ru/api/auth/'

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

export async function signUp( first_name, last_name, email, password, password_confirmation ){
  return await axios.post(`${URL}register`, {first_name, last_name, email, password, password_confirmation});
}

export async function signIn(email, password){
  return await axios.post(`${URL}login`, { email, password});
}

export async function testSignIn(){
  return await axios.post(`${URL}login`, { email:'nesterov16@mail.ru', password: '8ihQ7sgU'});
}

export async function getUserProfile(){
  let accessToken = '';
  if(getCookie('accessToken') !== 'undefined'){
    accessToken = getCookie('accessToken');
  }
  if(localStorage.getItem('token')){
    accessToken = localStorage.getItem('token');
  }

  const instance = axios.create({
    baseURL: 'URL',
    timeout: 1000,
    headers: {'Authorization': `Bearer ${accessToken}`}
  });

  return await instance.get(`${URL}user-profile`);
}

export async function restore(email){
  return await axios.post(`${URL}restore`, {email});
}

export async function logout(){
  let accessToken = '';
  if(getCookie('accessToken') !== 'undefined'){
    accessToken = getCookie('accessToken');
  }
  if(localStorage.getItem('token')){
    accessToken = localStorage.getItem('token');
  }
  const instance = axios.create({
    baseURL: 'URL',
    timeout: 1000,
    headers: {'Authorization': `Bearer ${accessToken}`}
  });
  return await instance.post(`${URL}logout`);
}

