'use strict';

import { useState } from 'react';
import DropDownMenu from './DropDownMenu';

export default function DropDownMenuWrapper() {
    const [isDropDownMenuShown, setIsDropDownMenuShown] = useState(false);
  
    let puzzlesNavbarButton = document.getElementById('puzzles-navbar-button');
  
    function handleDropDownMenu() {
      setIsDropDownMenuShown((prev) => !prev);
      puzzlesNavbarButton.removeEventListener('click', handleDropDownMenu);
    }
  
    puzzlesNavbarButton.addEventListener('click', handleDropDownMenu);
  
    return <DropDownMenu puzzles={puzzles} isDropDownMenuShown={isDropDownMenuShown} />
};