'use strict'; 

export default function globalErrorsHandler(message: string, url: string, line: number) {
  console.error(
    `%s\r\n in origin - %s\r\n on the line - %o`, 
    message, url, line
  );

  return true;
}