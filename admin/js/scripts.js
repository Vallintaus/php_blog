// selectAllBoxes
// checkBoxes
//CHECKBOXES
$(document).ready(function () {
  $("#selectAllBoxes").click(function (event) {
    if (this.checked) {
      $(".checkBoxes").each(function () {
        this.checked = true;
      });
    } else {
      $(".checkBoxes").each(function () {
        this.checked = false;
      });
    }
  });
});

//MODAL
// $(document).ready(function () {
//   $(".delete_link").on("click", function () {
//     let id = $(this).attr("rel");
//     let delete_url = "posts.php?delete=" + id + " ";

//     $(".modal_delete_link").attr("href", delete_url);

//     $("#myModal").modal("show");
//   });
// });

// USERS ONLINE
function loadUsersOnline() {
  $.get("functions.php?onlineusers=result", function (data) {
    $(".usersonline").text(data);
  });
}

// LOADING SCREEN -- not working
setInterval(function () {
  loadUsersOnline();
}, 1000);

loadUsersOnline();
