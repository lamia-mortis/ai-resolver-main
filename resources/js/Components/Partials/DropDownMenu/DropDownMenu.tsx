'use strict';

import React from 'react';
import { IDropDownMenuData } from '../../../interfaces/types';

interface IDropDownMenuProps {
  data: Array<IDropDownMenuData>;
}

export default function DropDownMenu({ data }: IDropDownMenuProps): JSX.Element {
  return (
    <ul className='drop-down-menu'>
      {data.map((row, index) => {
        return (
          <li key={index}>
            <a href={row.url}>{row.name}</a>
          </li>
        );
      })}
    </ul>
  );
}
