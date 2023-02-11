'use strict';

import React from 'react';
import { IDropDownMenuData } from '../../../interfaces/types';

interface IDropDownMenuProps {
  data: Array<IDropDownMenuData>;
}

export default function DropDownMenu({ data }: IDropDownMenuProps): JSX.Element {
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
