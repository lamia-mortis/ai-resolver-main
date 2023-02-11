'use strict';

import { Page, PageProps } from '@inertiajs/inertia';

export interface IDropDownMenuData {
  key: string;
  name: string;
  url: string;
}

export interface IFlexibleConfigData {
  flexible_config: ICommonConfigData;
}

export interface ICommonConfigData {
  logging: ILoggingData;
}

export interface ILoggingData {
  server_side: boolean;
}

export interface ISharedData extends Page<PageProps> {
  puzzles: Array<IDropDownMenuData>;
  flexibleConfigIndexUrl: string;
}
