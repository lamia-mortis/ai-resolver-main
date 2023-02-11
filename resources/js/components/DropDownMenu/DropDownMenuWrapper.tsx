'use strict';

import React, { useState } from 'react';
import DropDownMenu from './DropDownMenu';
import { IPuzzle } from '../../interfaces/puzzles';

interface DropDownMenuWrapperProps {
  puzzles: Array<IPuzzle>;
}

export default function DropDownMenuWrapper({ puzzles }: DropDownMenuWrapperProps): JSX.Element {
  const [isDropDownMenuShown, setIsDropDownMenuShown] = useState<boolean>(false);
  const puzzlesNavbarButton = document.getElementById('puzzles-navbar-button');

  function handleDropDownMenu() {
    setIsDropDownMenuShown((prev) => !prev);
    puzzlesNavbarButton?.removeEventListener('click', handleDropDownMenu);
  }

  puzzlesNavbarButton?.addEventListener('click', handleDropDownMenu);

  return <DropDownMenu puzzles={puzzles} isDropDownMenuShown={isDropDownMenuShown} />;
}
