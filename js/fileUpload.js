$(document).ready(function (e) {
  // Submit form data via Ajax
  var load = localStorage.getItem("payload");
  $("#uploadUsername").val(JSON.parse(load).username);
  $("#callingUpload").on("submit", function (e) {
    e.preventDefault();
    $("#submit").val("Uploading");
    $.ajax({
      type: "POST",
      url: "uploadPic.php",
      data: new FormData(this),
      dataType: "json",
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
       if(response.uploaded==true)
       {
           window.location.reload();
       }
       window.location.reload();
      },
    });
  });
});
