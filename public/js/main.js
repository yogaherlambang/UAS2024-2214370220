const deleteConfirmation = function(obj) {
  let modalHolder = document.querySelector("#modals");
  let href = obj.href;

  let modal = `
        <div class="modal fade " id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confim</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fa fa-exclamation-triangle text-warning my-2" style="font-size:70px;"></i>
                        <p>Are you sure want to delete this?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
                        <button type="button" id="agree" class="btn btn-primary">Yes</button>
                    </div>
                </div>
            </div>
        </div>`;

  modalHolder.innerHTML = modal;
  $("#deleteModal").modal("show");

  $("#agree").click(function() {
    $("#deleteModal").modal("hide");
    window.location = href;
  });

  return false;
};

const submitResetFrom = function() {
  $("#resetFrom").submit();
};


function updateProfilePicture(event){
  let file = event.target.files[0];

  let user_id = $('#user_id').val();

  const data = new FormData();
  data.append('file', file);
  data.append('user_id', user_id);
  $('#upload-text').text('Please wait...');

  $.ajax({
    url: '/user/update-profile-picture',
    type: 'post',
    dataType: 'text',
    processData: false,
    contentType: false,
    data: data,
    success: function(response){
      const res = JSON.parse(response);
      $('#avatar').attr('src', res.imgUrl);
      $('#upload-text').text('Upload');
    },
    error: function(response){
      const res = JSON.parse(response.responseText);
      $('#alert').html(`
        <div class="alert alert-danger alert-dismissable">
            <a class="panel-close close" data-dismiss="alert">×</a>
            <i class="fa fa-times"></i>
            <strong>Failed! </strong> ${res.msg}
        </div>
      `);
      $('#upload-text').text('Upload');
    }
  });
}