'use strict'; 

import { types } from 'sass';
import { getSharedData } from '../helpers/helpers';
import { ISharedData } from '../interfaces/types';

export default function globalErrorsHandler(message: string, url: string, line: number, column: number, error) {
  const props : ISharedData | undefined  = getSharedData('props');
  const serverSideLogging : boolean = props === undefined ? false : props.shared_flexible_config?.logging?.server_side;
  
  if (serverSideLogging) {
    const saveLogsUrl : string = props.saveLogsUrl;
    axios.post(saveLogsUrl, {message, backTrace: error.stack});
  } else {
    console.error(
      `%s\r\n in origin - %s\r\n on the line - %i`, 
      message, url, line
    );
  }

  return true;
}