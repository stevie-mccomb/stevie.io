import axios from 'axios';

axios.defaults.headers.common['X-CSRF-TOKEN'] = window.Laravel.csrfToken;
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

export default axios;
