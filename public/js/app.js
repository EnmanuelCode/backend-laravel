var app = function () {
    var cubeSummary = function () {
        $('#form-data-charge').validate({
            rules: {
                indata: {
                    required: true
                }
            },
            messages: {
                indata: {
                    required: "Este campo es obligatorio"
                }
            }
        });
    }

    return {
        init: function () {
            cubeSummary();
        }
    }
}();


$(document).on("ready", function () {

    $("#form-data-charge").submit(function (event) {
        return false;
    });

    $("#btn-calculate-summary").on("click", function () {
        if ($('#form-data-charge').validate().form()) {
            $('#cube-summary').html('');
            $.ajax({
                type: "POST",
                url: "cube/summary",
                encoding:"UTF-8",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    indata: $('#indata').val()
                },
                success: function (process) {
                    if(process.status){
                        var elements = process.tests;
                        var key;
                        
                        for(key in elements) {
                            $('#cube-summary').append(elements[key]);
                        }
                    }
                }
            });
        }

    });
});