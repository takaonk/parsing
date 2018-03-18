@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row wow fadeIn">
		<h1>Selamat Datang Di Menu Halaman Home</h1>
		<div class="col-sm-12">
			<div id="accordion" role="tablist" aria-multiselectable="true" class="panel-group">
				<div class="panel panel-default">
					<div id="headingOne" role="tab" class="panel-heading">
						<h4  class="panel-title"><a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Home</a></h4>
					</div>
					<div id="collapseOne" role="tabpanel" aria-labelledby="headingOne" class="panel-collapse collapse in">
          <div class="panel-body">
            </div>
						<div class="panel-body">
							{{-- <p> <a class="btn btn-primary" href="Home/edit">Edit</a> </p> --}}
							{!! $html->table(['class'=>'table-striped']) !!}
						</div>
					</div>
				</div>        </div>
      </div>
   </div>
 </div>
</div>
</div>
</div>
@endsection
@section('scripts')
{!! $html->scripts() !!}
@endsection