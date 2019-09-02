import axios from 'axios'
import API from '../../API.js'

export const http = axios.create({
    baseURL: API.api,
})

window.axios = require('axios');

let token = document.head.querySelector('meta[name="csrf-token"]');

window.token = token.content
http.defaults.headers.common = {
  'X-CSRF-TOKEN': token.content,
  'X-Requested-With': 'XMLHttpRequest'
};

http.interceptors.response.use(function(response) {
  return response;
}, function(error) {
  const { response } = error
  
  if ([401].indexOf(response.status) >= 0) {
    
    if (response.status == 401 && response.data.error.message != 'Unauthorized') {
      return Promise.reject(response);
    }
    if ( window.location.pathname != '/login' || window.location.pathname != '/' )
      window.location = '/';
  }

  if ([403].indexOf(response.status) >= 0) {
    if (response.data.message === 'not_permission')
      window.location.assign('/admin/home')
  }

  return Promise.reject(error);
});

export default http