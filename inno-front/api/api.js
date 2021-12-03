const axios = require('axios');

const URL = 'http://innoapi.cyberbobs.xsph.ru/api/';
const auth = 'auth/'

function getCookie(name) {
  let matches = document.cookie.match(new RegExp(
    "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
  ));
  return matches ? decodeURIComponent(matches[1]) : undefined;
}

function getToken(){
  let accessToken = '';
  if(localStorage.getItem('token')){
    accessToken = localStorage.getItem('token');
  }
  if(getCookie('accessToken') !== 'undefined'){
    accessToken = getCookie('accessToken');
  }

  return accessToken;
}

export async function signUp( first_name, last_name, email, password, password_confirmation ){
  return await axios.post(`${URL}${auth}register`, {first_name, last_name, email, password, password_confirmation}, { headers: { "Access-Control-Allow-Origin": "*", } });
}

export async function signIn(email, password){
  return await axios.post(`${URL}${auth}login`, { email, password}, { headers: { "Access-Control-Allow-Origin": "*", } } );
}

export async function testSignIn(){
  return await axios.post(`${URL}${auth}login`, { email:'nesterov16@mail.ru', password: '8ihQ7sgU'}, { headers: { "Access-Control-Allow-Origin": "*", } } );
}

export async function getUserProfile(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });

  return await instance.get(`${URL}${auth}user-profile`);
}

export async function restore(email){
  return await axios.post(`${URL}${auth}restore`, {email}, { headers: { "Access-Control-Allow-Origin": "*", } } );
}

export async function logout(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.post(`${URL}${auth}logout`);
}

export async function startups(query, page, direction_id, project_stage_id, transport_type_id, cert_type_id){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.post(`${URL}startups`, { query, page, direction_id,project_stage_id,transport_type_id,cert_type_id } );
}

export async function getStartup(id){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.get(`${URL}startups/${id}`);
}

export async function directions(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.get(`${URL}directions`);
}

export async function certs(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.get(`${URL}certs`);
}

export async function transport(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.get(`${URL}transport`);
}

export async function project_stages(){
  let accessToken = getToken();
  const instance = axios.create({
    baseURL: URL,
    headers: {'Authorization': `Bearer ${accessToken}`, "Access-Control-Allow-Origin": "*"}
  });
  return await instance.get(`${URL}project_stages`);
}



