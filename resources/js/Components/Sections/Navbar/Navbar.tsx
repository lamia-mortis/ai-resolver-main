'use strict';

import React, { useState } from 'react';
import { usePage } from '@inertiajs/react';
import { IDropDownMenuData } from '../../../interfaces/types';
import DropDownMenu from '../../Partials/DropDownMenu/DropDownMenu';

export default function Navbar() {
  const { puzzles, flexibleConfigIndexUrl } = usePage().props;
  const puzzlesTyped = puzzles as Array<IDropDownMenuData>;
  const flexibleConfigIndexUrlTyped = flexibleConfigIndexUrl as string;
  const [isDropDownMenuShown, setIsDropDownMenuShown] = useState(false);

  return (
    <div className='navbar'>
      <div className='navbar-container'>
        <ul className='nav col-8 col-lg-auto my-2 justify-content-around d-flex my-md-0 text-small'>
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
              {isDropDownMenuShown && <DropDownMenu data={puzzlesTyped} />}
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
            <a href={flexibleConfigIndexUrlTyped} className='nav-link text-secondary text-center'>
              Flexible Configuration
            </a>
          </li>
        </ul>
      </div>
    </div>
  );
}
