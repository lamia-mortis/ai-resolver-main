export function createRenderableConfigName(str: string): string {
  const strArr = str.split('_');
  const firstBigLetter = strArr[0][0].toUpperCase();
  const wordSecondPart = strArr[0].slice(1);
  const firstWord = firstBigLetter + wordSecondPart;
  return [firstWord, ...strArr.slice(1)].join(' ');
}
