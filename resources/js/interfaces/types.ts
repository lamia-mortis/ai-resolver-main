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

export interface ISharedFlexibleConfigData {
  logging: ILoggingData;
}

export interface ISharedData extends Page<PageProps> {
  flexibleConfigIndexUrl: string;
  puzzles: Array<IDropDownMenuData>;
  saveLogsUrl: string;
  shared_flexible_config: ISharedFlexibleConfigData;
}
