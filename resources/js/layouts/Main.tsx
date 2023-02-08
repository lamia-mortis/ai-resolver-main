'use strict';

import React from 'react';
import ReactDOM from 'react-dom/client';
import SudokuIndex from '../Sudoku/SudokuIndex';
import RubikCubeIndex from '../RubikCube/RubikCubeIndex';
import DropDownMenuWrapper from '../components/DropDownMenu/DropDownMenuWrapper';

const Components = {
  'sudoku-index': SudokuIndex,
  'rubik-cube-index': RubikCubeIndex,
};

const componentName = pageInfo.currentPuzzle + '-' + pageInfo.type;
const Element = getComponent(componentName);
// TODO create custom errorHandler to handle null Elements
const dropDownMenuContainer = document.getElementById('puzzles-navbar-container');
const puzzleMainContainer = document.getElementById(`${pageInfo.currentPuzzle}-main-container`);

function getComponent(componentName) {
  return Components[componentName];
}

ReactDOM.createRoot(dropDownMenuContainer as Element).render(<DropDownMenuWrapper puzzles={puzzles} />);
ReactDOM.createRoot(puzzleMainContainer as Element).render(<Element />);