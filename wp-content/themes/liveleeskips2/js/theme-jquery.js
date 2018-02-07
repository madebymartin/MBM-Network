jQuery(document).ready(function( $ ) {

	$("input[type='text']").on("click", function () {
       $(this).select();
       $("img.validarea").hide();
    });


    $('button.showmodal').on('click', function () {
        var id = $(this).data("modal");
        console.log(id);

        // $(this).data("id");
        
        $(".effeckt-modal-wrap").show();
        
        window.setTimeout(function() {
            $(".effeckt-modal-wrap#" + id).addClass('md-effect-8');
            $(".effeckt-modal-wrap#" + id).addClass("effeckt-show");
            $('.effeckt-overlay').addClass("effeckt-show");
            $('body').addClass("modalopen");

            $(".effeckt-modal-close, .effeckt-overlay").on("click", function () {
                $(".effeckt-modal-wrap#" + id).fadeOut();
                $('.effeckt-modal-wrap#' + id).removeClass("effeckt-show");
                //$(".effeckt-modal-wrap").removeClass('md-effect-8');
                $('.effeckt-overlay').removeClass("effeckt-show");
                $('body').removeClass("modalopen");
            });
        }, 10);
    });

    
});