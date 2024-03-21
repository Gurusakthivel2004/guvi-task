document.getElementById("profile_update_button").onclick = (e) => {
  e.preventDefault();
  var formData = {
    age: $("#age").val(),
    dob: $("#dob").val(),
    contact: $("#contact").val(),
  };
  $.ajax({
    method: "POST",
    url: "http://localhost/login/php/profile_handler.php",
    data: formData,
    dataType: "json",
  })
    .done(function (data) {
      if (data.success) {
        window.location.href = "http://localhost/login/php/profile.php";
      } else {
        console.log(data.message);
      }
    })
    .fail((xhr, status, error) => {
      window.location.href = "http://localhost/login/php/profile.php";
      console.log(xhr.responseText);
    });
};
