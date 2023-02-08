'use strict';

import React from 'react';
import { Puzzle } from '../../interfaces/puzzles';

interface DropDownMenuProps {
  puzzles: Array<Puzzle>;
  isDropDownMenuShown: boolean;
}

export default function DropDownMenu({
  puzzles,
  isDropDownMenuShown,
}: DropDownMenuProps): JSX.Element {
  return (
    <div>
      {isDropDownMenuShown && (
        <ul>
          {puzzles.map((puzzle, index) => {
            return (
              <a key={index} href={puzzle.url}>
                <li>{puzzle.name}</li>
              </a>
            );
          })}
        </ul>
      )}
    </div>
  );
}
