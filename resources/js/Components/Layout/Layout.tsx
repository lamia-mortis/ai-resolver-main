'use strict';

import React from 'react';
import Navbar from '../Sections/Navbar/Navbar';

interface LayoutProps {
  children: JSX.Element;
}

export default function Layout({ children }: LayoutProps) {
  return (
    <>
      <header>
        <Navbar />
      </header>
      <main className='container'>{children}</main>
      <footer></footer>
    </>
  );
}
