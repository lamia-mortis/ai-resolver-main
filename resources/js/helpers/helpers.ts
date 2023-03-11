'use strict'

import globalErrorsHandler from "../errors/globalErrorsHandler";

export function createRenderableConfigName(str: string): string {
  const strArr = str.split('_');
  const firstBigLetter = strArr[0][0].toUpperCase();
  const wordSecondPart = strArr[0].slice(1);
  const firstWord = firstBigLetter + wordSecondPart;
  return [firstWord, ...strArr.slice(1)].join(' ');
}

export function setSharedData(key: string, value: any): boolean {
  try {
    if (!Object.hasOwn(window, 'aiResolver')) window.aiResolver = {};
    window.aiResolver[key] = value;

    return true;
  } catch(exception) {
    globalErrorsHandler(exception.message, '', 0, 0, exception);
    return false;
  }
}

export function getSharedData(key: string): any {
  if (Object.hasOwn(window, 'aiResolver') && Object.hasOwn(window.aiResolver, key)) return window.aiResolver[key];
  return undefined;
}
