$("input[name=q]").on("input", function () {
    $.ajax({
        url: $(this).parents('form').attr('data-action'),
        data: {q: $(this).val()}
    }).done(function (data) {
        $("#sidebar-menu").html(data);
    });
});