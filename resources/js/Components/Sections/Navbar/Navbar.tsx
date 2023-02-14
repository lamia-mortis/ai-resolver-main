'use strict';

import React, { useState } from 'react';
import { usePage } from '@inertiajs/react';
import DropDownMenu from '../../Partials/DropDownMenu/DropDownMenu';
import { SharedPropsInterface } from '../../../interfaces/types';

export default function Navbar() {
  const { puzzles }: SharedPropsInterface = usePage().props;
  const [isDropDownMenuShown, setIsDropDownMenuShown] = useState(false);

  return (
    <div className='navbar-container container'>
      <div className='d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start'>
        <ul className='nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small'>
          <li>
            <a
              id='puzzles-navbar-button'
              href='javascript:void(0)'
              className='nav-link text-white'
              onClick={() => {
                setIsDropDownMenuShown((prev) => !prev);
              }}
            >
              What to solve?
            </a>
            <div id='puzzles-navbar-container'>
              {isDropDownMenuShown && <DropDownMenu data={puzzles} />}
            </div>
          </li>
          <li>
            <a
              id='algoritms-navbar-button'
              href='javascript:void(0)'
              className='nav-link text-secondary'
            >
              Algorithms
            </a>
          </li>
          <li>
            <a
              id='history-navbar-button'
              href='javascript:void(0)'
              className='nav-link text-secondary'
            >
              History
            </a>
          </li>
          <li>
            <a href='javascript:void(0)' className='nav-link text-secondary'>
              Placeholder
            </a>
          </li>
          <li>
            <a href='javascript:void(0)' className='nav-link text-secondary'>
              Placeholder
            </a>
          </li>
        </ul>
      </div>
    </div>
  );
}
