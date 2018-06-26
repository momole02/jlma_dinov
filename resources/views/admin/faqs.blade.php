@extends('admin/skeleton')

@section('title')
    --JLMA-- FAQs
@endsection

@section('headerTitle')
    FAQS
@endsection

@section('headerDescription')
    Gérer la foire aux questions JLMA
@endsection

@section('content')

    <div class="row">
        <div class="col-lg-7">
            <div class="box box-info ">
                <div class="box-header with-border">
                    <h3 class="box-title">Listing des FAQs</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->

                <div class="box-body ">
                    <b style="color:red">Seules les 6 premières questions seront visibles sur la plateforme !!</b>
                    @isset($faqs)
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>#</th>
                                <th>Question</th>
                                <th>Réponse</th>
                                <th>Supprimer</th>
                            </tr>
                            @foreach( $faqs as $faqEntry )
                                <tr>
                                    <td>{{$faqEntry->id_faq}}</td>
                                    <td>{{$faqEntry->question_faq}}</td>
                                    <td>{!! nl2br($faqEntry->reponse_faq) !!}</td>
                                    <td><a href="{{route('adminDoDropFaq',['slug'=>$faqEntry->slug])}}" class="btn btn-danger">Supprimer</a></td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    @endisset
                </div>

                <!-- /.box-body -->
                <div class="box-footer">

                </div>

                </form>
            </div>
        </div>
        <div class="col-lg-5" style="height:500px">
            <div class="box box-info box-solid ">
                <div class="box-header with-border">
                    <h3 class="box-title">Ajout question</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                    <!-- /.box-tools -->
                </div>

                <!-- /.box-header -->

                <div class="box-body">
                    <form class="form" method="post" action="{{route('adminDoAddFaq')}}">
                        @csrf
                        <div class="form-group">
                            <label for="faq-question">Question</label>
                            <input type="text" class="form-control" name="faq-question" id="faq-question" required>
                        </div>
                        <div class="form-group">
                            <label for="faq-response">Reponse</label>
                            <textarea rows="10" class="form-control"name="faq-response" id="faq-question" required></textarea>
                        </div>
                        <button class="btn btn-info pull-right" type="submit">Ajouter</button>
                    </form>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">

                </div>

                </form>
            </div>
        </div>

    </div>

@endsection

@section('extra-css')
    <link rel="stylesheet" href="{{asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
@endsection

@section('extra-scripts')

    <script src="{{asset('admin/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
    <script>

        $(function () {
            $('#example1').DataTable()
            $('#example2').DataTable({
                'paging'      : true,
                'lengthChange': false,
                'searching'   : false,
                'ordering'    : true,
                'info'        : true,
                'autoWidth'   : false
            })
        })
    </script>
@endsection


