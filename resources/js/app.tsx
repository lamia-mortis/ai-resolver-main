'use strict';

import './bootstrap';
import React from 'react';
import { createInertiaApp } from '@inertiajs/react';
import { createRoot } from 'react-dom/client';
import GlobalErrorsHandler from './errors/globalErrorsHandler';
import { setSharedData } from './helpers/helpers';

try {
  createInertiaApp({
    resolve: (name) => {
      const pages = import.meta.glob('./Components/Pages/**/*.tsx', { eager: true });
      return pages[`./Components/Pages/${name}.tsx`];
    },
    setup({ el, App, props }) {
      setSharedData('props', props.initialPage.props);
      createRoot(el).render(<App {...props} />);
    },
  });
} catch(exception) {
  GlobalErrorsHandler(exception.message, '', 0, 0, exception);
}

window.onerror = GlobalErrorsHandler;
