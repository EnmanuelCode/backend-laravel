<html>
    <head>
        <title>cube summation</title>
        <meta name="csrf-token" content="{!! csrf_token() !!}" />
        
        {!! HTML::style('plugins/bootstrap/css/bootstrap.css') !!}
    </head>
    <body>
        <div class="container">
            <div class="content page-header">
                <div class="row">
                    <div class="col-md-5">
                        <form id="form-data-charge">
                            <div class="form-group">
                                <label>Sample Input</label>
                                <textarea name="indata" id="indata" class="form-control" rows="10"></textarea>
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary btn-block" id="btn-calculate-summary">calculo de cubos</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <div class="row" id="cube-summary"></div>
                    </div>
                </div>
            </div>
        </div>
        
        {!! HTML::script('plugins/jquery/jquery-2.1.4.js') !!}
        {!! HTML::script('plugins/jquery/jquery.validate.min.js') !!}
        
        {!! HTML::script('js/app.js') !!}
        
        <script>
            $(document).ready(function () {
                app.init();
            });
        </script>
        
    </body>
</html>
