$(".edit-category-modal").on("click", function() {
    var id = $(this).data('category').id;
    var category_name = $(this).data('category').category_name;
    var icon = $(this).data('category').icon;
    $(".modal-body #category_name_edit").val(category_name);
    $(".modal-body #icon_edit").val(icon);
    $('#formEditCategory').attr('action', '/admin/categories/' + id);
});

$(".delete-category-modal").on("click", function() {
    var id = $(this).data('id');
    $('#formDeleteCategory').attr('action', '/admin/categories/' + id);
});