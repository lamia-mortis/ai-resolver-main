@extends('layouts.main')

@section('title', 'Sudoku')

@section('content')
    @javascript('pageInfo', $pageInfo)
    <div id="{{ $pageInfo['currentPuzzle'] }}-main-container" class="text-white"></div> 
@endsection