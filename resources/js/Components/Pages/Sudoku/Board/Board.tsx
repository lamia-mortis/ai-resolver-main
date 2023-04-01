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
  const [solvedSudokuBoard, setSolvedSudokuBoard] = useState<Array<Array<number>>>([]);
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
  }, [sudokuBoard]);

  useEffect(() => {
    let timer = 100;

    solvedSudokuBoard && solvedSudokuBoard.forEach((solvedRow: number[], yIndex: number) => {
      solvedRow.forEach((solvedCell: number, xIndex: number) => {
        if(sudokuBoard[yIndex][xIndex]) return;
        setTimeout(() => {        
          setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, solvedCell.toString(), yIndex, xIndex));
        }, timer);

        timer += 100;
      })
    })
  }, [solvedSudokuBoard])

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

  function isValueInRange(input: string | number) {
    return /^[0-9]$/.test(input.toString());
  }

  function updateSudokuBoard (
    prevBoard: (number | string)[][],
    valueToAdd: string,
    yIndex: number,
    xIndex: number,
  ) {
    const updatedBoard: (number | string)[][] = _.cloneDeep(prevBoard);
    updatedBoard[yIndex][xIndex] = valueToAdd;
    return updatedBoard;
  }

  function handleInputValue(event: React.ChangeEvent<HTMLInputElement>, yIndex: number, xIndex: number) {
    setMessage('');

    // return 0 explicitly to avoid NaN during the empty string convertion to number
    // 0 will be replaced with an empty string during the sudoku board updating
    const valueToAdd = event.currentTarget.value === '' || event.currentTarget.value === '0' ? 0 : event.currentTarget.value;
    if (!isValueInRange(valueToAdd)) return;

    // in case of removing value or value equals 0
    if (!valueToAdd) {
      setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, '', yIndex, xIndex));
      return;
    }

    if (!validateCell(valueToAdd, yIndex, xIndex, squareSize, sudokuBoard)) {
      setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, valueToAdd, yIndex, xIndex));
      return;
    }

    event.currentTarget.style.backgroundColor = '';
    setSudokuBoard(prevBoard => updateSudokuBoard(prevBoard, valueToAdd, yIndex, xIndex));
  }
  
  function handleSubmit(sudokuSolveUrlTyped: string, sudokuBoard: (number | string)[][]) {
    if (!isBoardValid) {
      setMessage('You have unsuitable numbers marked with red colour');
      setMessageVariant('danger');
      return;
    }

    function prepareRequestData(): ISudokuData {
      const requestData: ISudokuData = {board:[[]], squareSize:3};

      requestData.board = sudokuBoard.map((row: (number | string)[]) => {
          return row.map((cell: number | string) => {
            return cell === '' ? 0 : Number(cell);
          })
      }) 

      requestData.squareSize = squareSize;
      return requestData;
    } 

    axios.post(sudokuSolveUrlTyped, prepareRequestData())
      .then((response) => {
        const solvedSudokuData: ISudokuData = response.data.sudoku;
        setSolvedSudokuBoard(solvedSudokuData.board)
      });
  }

  return (
    <div className='sudoku-board-container'>
      SUDOKU BOARD
      {message && <Alert variant={messageVariant}>{message}</Alert>}
      <table className='sudoku-board'>
        <tbody>
          {sudokuBoard &&
            sudokuBoard.map((row: (string | number)[], yIndex: number) => {
              return (
                <tr key={yIndex} className='sudoku-board-row'>
                  {row.map((cell: string | number, xIndex: number) => (
                    <td key={xIndex} className='sudoku-board-cell'>
                      {
                        <input
                          className='sudoku-board-input'
                          value={sudokuBoard[yIndex][xIndex]}
                          ref={sudokuBoardRefs.current[yIndex][xIndex]}
                          type='text'
                          onChange={(event: React.ChangeEvent<HTMLInputElement>) => {
                            handleInputValue(event, yIndex, xIndex);
                          }}
                        />
                      }
                    </td>
                  ))}
                </tr>
              );
            })
          }
        </tbody>
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
