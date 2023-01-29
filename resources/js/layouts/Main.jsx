'use strict';

import ReactDOM from 'react-dom/client';
import SudokuIndex from '../Sudoku/SudokuIndex';
import RubikCubeIndex from '../RubikCube/RubikCubeIndex';
import DropDownMenuWrapper from '../components/DropDownMenu/DropDownMenuWrapper';

const Components = {
  'sudoku-index': SudokuIndex,
  'rubik-cube-index': RubikCubeIndex,
};

const componentName = pageInfo.currentPuzzle + '-' + pageInfo.type;
const dropDownMenuContainer = document.getElementById('puzzles-navbar-container');
const dropDownMenuRoot = ReactDOM.createRoot(dropDownMenuContainer);
dropDownMenuRoot.render(<DropDownMenuWrapper />);

function getComponent(componentName) {
  return Components[componentName];
}

const Element = getComponent(componentName);
ReactDOM.createRoot(document.getElementById(`${pageInfo.currentPuzzle}-main-container`)).render(
  <Element />
);
