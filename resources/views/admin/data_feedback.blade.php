@extends('template.template_admin')

@section('content')

<div class="col-12">
	<div class="card card-widget">
		<div class="card-header">
	        <div class="user-block">
	        	<h3>Data Feedback</h3>
	        </div>
	        <div class="card-tools">
	          <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
	          </button>
	          <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
	          </button>
	        </div>
	    </div>
	@foreach($data_feedback as $d)
    <div class="card-footer card-comments">
        <div class="card-comment">
          <img class="img-circle img-sm" src="{!! asset('assets/images/person.png') !!}" alt="User Image">

          <div class="comment-text">
            <span class="username">
              {{$d->name}}
              <span class="text-muted float-right">{{date('D, d M Y | H:i A', strtotime($d->created_at))}}</span>
            </span>
            Feedback : {{$d->krisar}}
          </div>
        </div>
    </div>
    @endforeach
    </div>
</div>

@endsection