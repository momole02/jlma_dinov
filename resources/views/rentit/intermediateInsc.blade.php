@extends('rentit/layout')

@section('contents')
	
	@include('rentit/components/breadcrumbs' , [
		'title' => "Inscription"
	])

<section class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="tabs-wrapper content-tabs">


                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#t1" data-toggle="tab" aria-expanded="true">Parcs auto</a></li>
                        <li class=""><a href="#t2" data-toggle="tab" aria-expanded="false">Résidence</a></li>
                    </ul>

                    <div class="tab-content">
                        
                        <div class="tab-pane fade active in" id="t1">
                        	<form>
                        		
                        	</form>
                        </div>


                        <div class="tab-pane fade" id="t2">
                        	Continuer en tant residence
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



