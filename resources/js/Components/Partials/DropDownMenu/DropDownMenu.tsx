'use strict';

import React from 'react';
import { DropDownMenuData } from '../../../interfaces/types';

interface DropDownMenuProps {
  data: Array<DropDownMenuData>;
}

export default function DropDownMenu({ data }: DropDownMenuProps): JSX.Element {
  return (
    <ul>
      {data.map((row, index) => {
        return (
          <a key={index} href={row.url}>
            <li>{row.name}</li>
          </a>
        );
      })}
    </ul>
  );
}
