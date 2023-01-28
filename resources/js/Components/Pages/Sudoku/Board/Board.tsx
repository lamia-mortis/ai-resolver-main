'use strict';

import React, { useEffect, useState, useRef, createRef } from 'react';
import { usePage } from '@inertiajs/react';
import { Alert } from 'react-bootstrap';
import { validateCell } from './helpers';

interface IBoardProps {
  setMessage: (value: string) => void;
  message: string;
  messageVariant: string;
  setMessageVariant: (value: string) => void;
}

interface ISudokuData {
  board: number[][];
  squareSize: number;
}

export function Board({ setMessage, message, messageVariant, setMessageVariant }: IBoardProps) {
  const size = 9;
  const squareSize = 3;
  const sudokuBoardRefs = useRef<Array<Array<HTMLInputElement>>>([]);

  const { sudokuSolveUrl } = usePage().props;

  const [sudokuBoard, setSudokuBoard] = useState<Array<Array<number | string>>>([]);
  const [isBoardValid, setIsBoardValid] = useState<boolean>(true);
  const sudokuSolveUrlTyped = sudokuSolveUrl as string;

  sudokuBoardRefs.current = [];

  for (let i = 0; i < 9; i++) {
    const row: HTMLInputElement[]  = [];

    for (let j = 0; j < 9; j++) {
      row.push(createRef<HTMLInputElement>()); 
    }
    
    sudokuBoardRefs.current.push(row);
  }

  useEffect(() => {
    setSudokuBoard([]);

    const sukdokuBoardRefreshed: Array<Array<string>> = [];
    let counter = size;

    while (counter) {
      sukdokuBoardRefreshed.push(Array(size).fill(''));
      counter--;
    }

    setSudokuBoard(() => {
      return sukdokuBoardRefreshed;
    });
  }, []);

  useEffect(() => {
    const isBoardValid = validateEntireBoard(sudokuBoard);
    setIsBoardValid(isBoardValid);
  },[sudokuBoard]);

  function changeCellHighlightning(isRemove: boolean ,xIndex: number, yIndex: number) {
    sudokuBoardRefs
        .current[yIndex][xIndex]
        .current.style.backgroundColor = isRemove ? '' : '#F8D7DA';
  }

  function validateEntireBoard(currentBoard: (number | string)[][]) {
    let isBoardValid = true;

    currentBoard.forEach((row: (number | string)[], yIndex: number) => {
      row.forEach((cell: number | string, xIndex: number) => {
        const isCellValid = validateCell(cell, yIndex, xIndex, squareSize, currentBoard);
        changeCellHighlightning(isCellValid, xIndex, yIndex);

        if (!isCellValid) isBoardValid = false;
      })
    })

    return isBoardValid;
  }

  function isValueInRange(input: number) {
    return /^[0-9]$/.test(input.toString());
  }

  function handleInputValue(event:React.ChangeEvent<HTMLInputElement>, yIndex:number, xIndex:number) {
    setMessage('');
    const valueToAdd = event.currentTarget.value === '' ? 0 : event.currentTarget.valueAsNumber;

    if (!isValueInRange(valueToAdd)) return;

    const updateSudokuBoard = (prevBoard: (number | string)[][], valueToAdd: number | string) => {
      const clonedBoard = _.cloneDeep(prevBoard)
      clonedBoard[yIndex][xIndex] = valueToAdd;
      return clonedBoard;
    }

    // in case of removing value or value equals 0
    if (!valueToAdd) {
      setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, ''));
      return;
    }

    if (!validateCell(valueToAdd, yIndex, xIndex, squareSize, sudokuBoard)) {
      setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, valueToAdd));
      return;
    }

    event.currentTarget.style.backgroundColor = '';
    setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, valueToAdd));
  }
  
  function handleSubmit(sudokuSolveUrlTyped: string, sudokuBoard: (number | string)[][]) {
    if (!isBoardValid) {
      setMessage('You have unsuitable numbers marked with red colour');
      setMessageVariant('danger');
      return;
    }

    function prepareRequestData() {
      const requestData: ISudokuData = {board:[[]], squareSize:3};

      requestData.board = sudokuBoard.map((row: (number | string)[]) => {
          return row.map((cell: number | string) => {
            return cell === '' ? 0 : Number(cell);
          })
      }) 

      requestData.squareSize = squareSize;
      return requestData;
    } 

    axios.post(sudokuSolveUrlTyped, prepareRequestData()).then((res) => console.log('res', res));
  }

  return (
    <div className='sudoku-board-container'>
      SUDOKU BOARD
      {message && <Alert variant={messageVariant}>{message}</Alert>}
      <table className='sudoku-board'>
        {sudokuBoard &&
          sudokuBoard.map((row: (string | number)[], yIndex: number) => {
            return (
              <tr key={yIndex} className='sudoku-board-row'>
                {row.map((cell: string |number, xIndex:number) => (
                  <td key={xIndex} className='sudoku-board-cell'>
                    {
                      <input
                        className='sudoku-board-input'
                        value={sudokuBoard[yIndex][xIndex]}
                        ref={sudokuBoardRefs.current[yIndex][xIndex]}
                        type='number'
                        onInput={(event: React.ChangeEvent<HTMLInputElement>) => {
                          event.currentTarget.value = event.currentTarget.value.replace(/[^1-9]/g, '');
                        }}
                        onChange={(event: React.ChangeEvent<HTMLInputElement>) => {
                          handleInputValue(event, yIndex, xIndex);
                        }}
                      />
                    }
                  </td>
                ))}
              </tr>
            );
          })}
      </table>
      <div>
        <button
          className='sudoku-board-submit'
          onClick={() => {
            handleSubmit(sudokuSolveUrlTyped, sudokuBoard);
          }}
        >
          Submit
        </button>
      </div>
    </div>
  );
}
