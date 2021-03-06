@extends('layouts.app')

@section('content')

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
    @include('common.errors')

    <!-- New Task Form -->
        <form action="/task/{{ $task->id }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- Task Name -->
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Task</label>

                <div class="col-sm-6">
                    <input type="text" name="name" id="task-name" class="form-control" value="{{$task->name}}">
                </div>
            </div>
            <div class="form-group">
                <label for="task-name" class="col-sm-3 control-label">Date</label>

                <div class="col-sm-6 date">
                    <input type="text" name="date_completion" id="task-date" class="form-control datepicker" value="{{$task->date_completion}}">
                </div>
            </div>

            <!-- Add Task Button -->
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" class="btn btn-default">
                        <i class="fa fa-plus"></i>Update task
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection