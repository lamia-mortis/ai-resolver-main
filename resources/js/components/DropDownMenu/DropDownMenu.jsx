'use strict';

import React from 'react';

export default function DropDownMenu({ puzzles, isDropDownMenuShown }) {
  return (
    isDropDownMenuShown && (
      <div>
        <ul>
          {puzzles.map((puzzle) => {
            return <a href={puzzle.url}><li>{puzzle?.name}</li></a> ;
          })}
        </ul>
      </div>
    )
  );
}
