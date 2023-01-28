export function validateCell(numberToAdd: number | string, yIndexToReplace: number, xIndexToReplace: number, size: number, sudokuBoard: (number | string)[][]) {

 const sudokuArrCopy: (number | string)[][] = _.cloneDeep(sudokuBoard);
 sudokuArrCopy[yIndexToReplace][xIndexToReplace] = '';

  let isValid = true;

  if (!numberToAdd) {
    return isValid
  }

  if (sudokuArrCopy[yIndexToReplace].includes(numberToAdd)) {
    isValid = false;
  }

  sudokuArrCopy.forEach((row) => {
    if (row[xIndexToReplace] === numberToAdd) {
      isValid = false;
      return;
    }
  });
  
  let xSquare: number = Math.ceil((xIndexToReplace + 1) / size);
  let ySquare: number = Math.ceil((yIndexToReplace + 1) / size);

  const skipXCells: number = --xSquare * size;
  const skipYCells: number = --ySquare * size;
  
  let initialX: number = skipXCells;
  let initialY: number = skipYCells;

  for (let i = size; i > 0; i--) {
    for (let j = size; j > 0; j--) {
      if (
        sudokuArrCopy[initialY][initialX] === numberToAdd &&
        initialY !== yIndexToReplace &&
        initialX !== xIndexToReplace
      ) {
        isValid = false;
        break;
      }
      initialY++;
    }
    initialY = skipYCells;
    initialX++;
  }
  return isValid;
}
