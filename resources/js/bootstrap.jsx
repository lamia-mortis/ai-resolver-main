import _ from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios; 

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import ReactDOM from 'react-dom/client';        
import RubikCube from './rubik-cube/RubikCube';
ReactDOM.createRoot(document.getElementById('rubik-cube-sample-content')).render(     
    <RubikCube />        
);
