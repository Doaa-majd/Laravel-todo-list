<!DOCTYPE html>
<html lang="en">
<head>
<title>My To-do's List</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Unicat project">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
<link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="container">
		<div class="row todo">
			<div class="col">
			
			<div class="title mb-5"><h1>My To-do's List -</h1></div>
			
			<div class="row no-gutters mb-4">
				<div class="col-3 mr-2">
					<input type="text" name="name" value="{{ old('name') }}" class="form-control input-task @error('name') is-invalid @enderror" placeholder="New Task...">
					
				</div>
				<div class="col-2"><button type="button" data-url="{{ route('store')}}" class="btn btn-primary add-task">Add To List</button></div>
			
			</div>
			
			<div class="row">
				<div class="col">
					<ul class="list-group todo-items">
                        @foreach($tasks as $key => $task)

                    <li class="list-group-item border-top-0 border-right-0 border-left-0 mb-1 @if ($task->status == 1) done @endif">
					   <div class="float-left task-text">{{$task->name}}</div>
					   <div class="float-right action" id="{{$task->id}}">
						 <a href ="#" data-url="{{ route('update',[$task->id])}}" class="done-action">Mark as Done </a>|
						 <a href ="#" data-url="{{ route('delete',[$task->id])}}" class="delete-action"> Delete</a>
                       </div>
                    </li>
                    @endforeach
					
					</ul>
				</div>
			</div>
			
			
			</div>
							
		</div>

	</div>
<script src="{{ asset('js/jquery-3.2.1.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

</body>
</html>