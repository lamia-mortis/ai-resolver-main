'use strict';

import GlobalErrorsHandler from './helpers/errors/GlobalErrorsHandler';
window.onerror = GlobalErrorsHandler;

import _, { words } from 'lodash';
window._ = _;

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
