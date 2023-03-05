'use strict';

import { Page, PageProps } from '@inertiajs/inertia';

export interface DropDownMenuData {
  key: string;
  name: string;
  url: string;
}

export interface SharedPropsInterface extends Page<PageProps> {
  puzzles: Array<DropDownMenuData>;
  flexibleConfigIndexUrl: string;
}
