$(function () {
    $('#createPostHome').on('input change', function() {
        $('#createPostHomeBtn').attr('disabled', false);
    });
});
$(function () {
    $('#createPostProfile').on('input change', function() {
        $('#createPostProfileBtn').attr('disabled', false);
    });
});
$(function () {
    $('#addComment').on('input change', function() {
        $('#addCommentBtn').attr('disabled', false);
    });
});
$(function () {
    $('#editPost').on('input change', function() {
        $('#editPostBtn').attr('disabled', false);
    });
});
