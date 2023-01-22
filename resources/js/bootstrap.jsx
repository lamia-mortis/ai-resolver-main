import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios; 

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import ReactDOM from 'react-dom/client';        
import Cube from './cube/Cube';
ReactDOM.createRoot(document.getElementById('cube-sample-content')).render(     
    <Cube />        
);
