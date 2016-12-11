$('#edit-button').on("click", function () {
    $("input").toggleClass('enabled');
    
    if($("input").hasClass('enabled')){
        $(this).text('Save');
        $("input").prop('disabled', false);
    }
    else {
        $("input").prop('disabled', true);
        $(this).text('Edit');
    }

});
